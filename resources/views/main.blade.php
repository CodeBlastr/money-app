<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @section("title")
                Defend Your Money App
            @show
        </title>

        @section('stylesheets')
            <link href="/fonts/dym-font/css/dym-font.css" rel="stylesheet" type="text/css">
            <link href="/css/app.css" rel="stylesheet" type="text/css">
        @show

        @section('javascript-head')
            <script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>
            <script>
                window.appEnv = window.appEnv || {};
                window.appEnv.plaidLinkPublicKey = "{!! config('plaid.plaidPublicKey') !!}"
            </script>
        @show
    </head>
    <body>
        <div id="vueApp">
            <div class="vueOnePage">
                <router-view></router-view>
            </div>
        </div>
        
        @section('javascript-footer')

            <script type="text/javascript" src="/js/app.js"></script>

            @if (getenv('APP_ENV') === 'local')
                <script id="__bs_script__">//<![CDATA[
                    document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.18.6'><\/script>".replace("HOST", location.hostname));
                    //]]>
                </script>
            @endif
        @show
    </body>
</html>
