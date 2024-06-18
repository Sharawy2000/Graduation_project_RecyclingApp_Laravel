<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class FirebaseAccessTokenManager
{
    public function getAccessToken()
    {
        $response = Http::get('https://rekiatestapi.pythonanywhere.com/get_access_token');

        if ($response->successful()) {
            $data = $response->json();
            return $data['access_token'];
        } else {
            return null; // Or handle the error as needed
        }
    }
}