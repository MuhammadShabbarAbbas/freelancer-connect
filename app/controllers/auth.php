<?php

namespace App\FreelancerConnect\app\controllers;


use League\OAuth2\Client\Provider\GenericProvider;
use Sydefz\OAuth2\Client\Provider\FreelancerIdentity;
use Sydefz\OAuth2\Client\Provider\FreelancerIdentityException;

class Auth
{


    /**
     * @throws FreelancerIdentityException
     */
    public function index()
    {
        $provider = new FreelancerIdentity([
            'clientId' => $_ENV['CLIENT_ID'],
            'clientSecret' => $_ENV['CLIENT_SECRET'],
            'redirectUri' => $_ENV['REDIRECT_URI'],
            'scopes' => ['basic'], // Optional only needed when retrieve access token
            'prompt' => ['select_account'], // Optional only needed when retrieve access token
            'advancedScopes' => [1, 3], // Optional only needed when retrieve access token
            'sandbox' => true, // to play with https://accounts.freelancer-sandbox.com
        ]);
        // Check given error
        if (isset($_GET['error'])) {
            exit($_GET['error']);
        } elseif (!isset($_GET['code'])) {
            // If we don't have an authorization code then get one
            // Fetch the authorization URL from the provider; this returns the
            // urlAuthorize option and generates and applies any necessary parameters
            $authorizationUrl = $provider->getAuthorizationUrl();

            // Redirect the user to the authorization URL.
            header('Location: ' . $authorizationUrl);
            exit;
        } else {
            try {
                // Try to get an access token using the authorization code grant.
                $accessToken = $provider->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);

                // Store this bearer token in your data store for future use
                // including these information
                // token_type, expires_in, scope, access_token and refresh_token
                session_start();
                $_SESSION['accessTokenArray'] = $provider->accessTokenArray;
                header('Location: http://localhost:8081/freelancer-connect/projects');
                // We have an access token, which we may use in authenticated
                // requests against the freelancer identity and freelancer API.
//                echo $accessToken->getToken() . "\n";
//                echo $accessToken->getRefreshToken() . "\n";
//                echo $accessToken->getExpires() . "\n";
//                echo ($accessToken->hasExpired() ? 'expired' : 'not expired') . "\n";

                // Using the access token, we may look up details about the
                // resource owner.
//                $resourceOwner = $provider->getResourceOwner($accessToken);
//                var_export($resourceOwner);
            } catch (FreelancerIdentityException $e) {
                // Failed to get the access token or user details.
                exit($e->getMessage());
            }
        }
    }
}