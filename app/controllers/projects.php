<?php

namespace App\FreelancerConnect\app\controllers;
use Sydefz\OAuth2\Client\Provider\FreelancerIdentity;
use Sydefz\OAuth2\Client\Provider\FreelancerIdentityException;

class Projects
{
    //display projects listing
    public function index()
    {
        session_start();
        $provider = new FreelancerIdentity(['sandbox' => true]);
        try {
            $provider->setAccessTokenFromArray($_SESSION['accessTokenArray']);
            if (!$provider->accessToken->hasExpired()) {
                $request = $provider->getAuthenticatedRequest(
                    'GET',
                    $provider->apiBaseUri . '/projects/0.1/projects/active/',
                    $provider->accessToken->getToken(),
                    [
                        "headers" => ["Content-Type" => "application/json"],
                    ]
                );
                $response = $provider->getParsedResponse($request);
                if(is_array($response) && isset($response['result']['projects'])){
                    foreach ($response['result']['projects'] as $project){
                        var_dump($project);
                    }
                }

            } else {
                header('Location: http://localhost:8081/freelancer-connect/');
            }
        } catch (FreelancerIdentityException $e) {
            // Failed to get response
            exit($e->getMessage());
        }
        catch (\Exception $e) {
            // Failed to get response
            exit($e->getMessage());
        }
    }
}