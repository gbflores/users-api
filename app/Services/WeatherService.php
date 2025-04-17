<?php

// app/Services/WeatherService.php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class WeatherService
{
    public function fetch(string $city): ?array
    {
        $response = Http::timeout(10)->get(env('WEATHER_API_URL'), [
            'q'     => $city,
            'appid' => env('WEATHER_API_KEY'),
            'units' => 'metric',
        ]);

        // 200 OK → retorna JSON
        if ($response->successful()) {
            return $response->json();
        }

        // 401, 404 etc. → loga e devolve null
        logger()->warning('Weather API error', [
            'city'   => $city,
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);

        return null;
    }
}
