<?php

namespace App\Services\Notifications;

use Exception;
use App\Services\FirebaseAccessTokenManager;

class NotificationService
{
    protected $fcm_access_token;

    public function __construct(FirebaseAccessTokenManager $fcm_access_token)
    {

        $this->fcm_access_token = $fcm_access_token;
        
    }

    public function sendNotification($tokens, $title, $body)
    {
        $accessToken = $this->fcm_access_token->getAccessToken();
        
        $message = [
            "message" => [
                "token" => $tokens,
                "notification" => [
                    "title" => $title,
                    "body" => $body,
                ],
            ]
        ];


        $dataString = json_encode($message);
        

        $headers = [
            'Authorization: Bearer '.$accessToken,
            'Content-Type: application/json',
        ];
        

        try{

            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/v1/projects/rekia-fbfe3/messages:send');
            
            curl_setopt($ch, CURLOPT_POST, true);
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
           
            
            // dd(curl_exec($ch));

            $response = curl_exec($ch);

            return $response;
        }
        catch(Exception $e){

            echo 'Caught exception: ', $e->getMessage(), "\n";

        }
        
    }
}