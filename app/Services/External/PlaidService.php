<?php

namespace App\Services\External;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PlaidService
{
    public  $plaid_api_url;
    public  $client;
    
    private $client_id;
    private $secret;
    private $publicKey;

    public function __construct(){
        $PlaidService = $this;
        
        if(config('plaid.plaidSetup') === false){
            exit('Sorry, but it looks like you need to setup plaid with your API Keys.');
        };

        $PlaidService->plaid_api_url = config('plaid.plaidApiUrl');
        $PlaidService->client_id = config('plaid.plaidClientId');
        $PlaidService->secret = config('plaid.plaidSecret');
        $PlaidService->publicKey = config('plaid.plaidPublicKey');

        $PlaidService->client = new Client([ 'base_uri' => $PlaidService->plaid_api_url ]);
    }

    public function getItem($accessToken){
        $PlaidService = $this;

        $tokenExchangePayload = [
            'json' => [
                'client_id' => $PlaidService->client_id,
                'secret' => $PlaidService->secret,
                'access_token' => $accessToken
            ],
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ];

        try {
            $response = $PlaidService->client->post('item/get', $tokenExchangePayload);
        }
        catch(\Exception $exception) {
            throw $exception;
        }

        $result = json_decode($response->getBody()->getContents());

        return $result->item;
    }

    public function getAccounts($accessToken){
        $PlaidService = $this;

        $tokenExchangePayload = [
            'json' => [
                'client_id' => $PlaidService->client_id,
                'secret' => $PlaidService->secret,
                'access_token' => $accessToken
            ],
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ];

        try {
            $response = $PlaidService->client->post('accounts/get', $tokenExchangePayload);
        }
        catch(\Exception $exception) {
            throw $exception;
        }
        
        $result = json_decode($response->getBody()->getContents());
        return $result->accounts;

    }

    public function getAccountsBalance($accessToken, array $accountIds){
        $PlaidService = $this;

        $tokenExchangePayload = [
            'json' => [
                'client_id' => $PlaidService->client_id,
                'secret' => $PlaidService->secret,
                'access_token' => $accessToken,
                'options' => [
                    'account_ids' => $accountIds
                ],
            ],
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ];

        try {
            $response = $PlaidService->client->post('accounts/balance/get', $tokenExchangePayload);
        }
        catch(\Exception $exception) {
            throw $exception;
        }

        $result = json_decode($response->getBody()->getContents());
        return $result->accounts;

    }

    public function getAuth($accessToken, $accountIds = null){
        $PlaidService = $this;

        $tokenExchangePayload = [
            'json' => [
                'client_id' => $PlaidService->client_id,
                'secret' => $PlaidService->secret,
                'access_token' => $accessToken
            ],
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ];

        try {
            $response = $PlaidService->client->post('auth/get', $tokenExchangePayload);
        }
        catch(\Exception $exception) {
            throw $exception;
        }

        $result = json_decode($response->getBody()->getContents());
        return $result->accounts;
    }

    public function exchangePublicToken($public_token){
        $PlaidService = $this;

        $tokenExchangePayload = [
            'json' => [
                'client_id' => $PlaidService->client_id,
                'secret' => $PlaidService->secret,
                'public_token' => $public_token
            ],
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ];

        try {
            $response = $PlaidService->client->post('item/public_token/exchange', $tokenExchangePayload);
        }
        catch(\Exception $exception) {
            throw $exception;
        }

        $result = json_decode($response->getBody()->getContents());

        return $result;
    }
}