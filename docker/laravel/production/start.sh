#!/bin/sh

echo "Running laravel-container's entrypoint file..."

echo "Deleting existing apache pid if present..."
if [ -f "$APACHE_PID_FILE" ]; then
    rm "$APACHE_PID_FILE"
fi

echo "Adding Oauth keys for Laravel..."
echo $OAUTH_PUBLIC_KEY > /var/www/html/storage/oauth-public.key
sed -i 's/\r /\n/g' /var/www/html/storage/oauth-public.key
echo $OAUTH_PRIVATE_KEY > /var/www/html/storage/oauth-private.key
sed -i 's/\r /\n/g' /var/www/html/storage/oauth-private.key
echo "Oauth keys added."

echo "Adding database key..."
echo $COMPOSE_PRIVATE_KEY > /etc/ssl/private/compose.key
sed -i 's/\r /\n/g' /etc/ssl/private/compose.key
echo "Database key added."

echo "Build the autoload file..."
composer dump-autoload
echo "autoload dumped."

echo "Running db migrations..."
php artisan --verbose migrate --force
if [ $? = 1 ]; then # if migrations failed
    echo "Migrations failed, alerting webmaster..."
    curl -s --user "api:${MAILGUN_SECRET}" https://api.mailgun.net/v3/$MAILGUN_DOMAIN/messages \
        -F from=$WEBMASTER_EMAIL \
        -F to=$WEBMASTER_EMAIL \
        -F subject="URGENT: ${APP_NAME} Failed To Migrate" \
        -F text="Your database may have been partially migrated but your container failed. This means your existing container could be using broken data."
    echo "Migrations failed, exiting..."
    exit 1
fi
echo "Migrations succeeded"

echo "Starting queue listener..."
php artisan queue:work --tries=3 &

echo "laravel-container is ready!"
php artisan serve --host=0.0.0.0 --port=80