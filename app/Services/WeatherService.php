<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function fetch(string $city): array
    {
        $response = Http::timeout(10)->get(env('WEATHER_API_URL'), [
            'q'     => $city,
            'appid' => env('WEATHER_API_KEY'),
            'units' => 'metric',
            'lang'  => 'pt_br',
        ]);

        // tratamento de erros
        $response->throw();   // lança exceção HTTP‑able se != 2xx

        return $response->json();
    }
}
