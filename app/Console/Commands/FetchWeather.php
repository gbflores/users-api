<?php

namespace App\Console\Commands;

use App\Models\Weather;
use App\Services\WeatherService;
use Illuminate\Console\Command;

class FetchWeather extends Command
{
    protected $signature = 'weather:fetch {city}';
    protected $description = 'Fetch weather from external API (/find) and store it';

    public function __construct(private WeatherService $service)
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $city   = $this->argument('city');
        $raw    = $this->service->fetch($city);

        if (!$raw) {
            $this->error("Falha ao obter clima de {$city}.");
            return self::FAILURE;
        }

        /* ───── NORMALIZAÇÃO ───── */
        if (isset($raw['main'])) {
            $payload = $raw;                          // /weather
        } elseif (isset($raw['list'])) {              // /find
            // se houver vários Canoas, pega o primeiro BR, senão o 0
            $payload = collect($raw['list'])
                ->firstWhere('sys.country', 'BR')
                ?? $raw['list'][0];
        } else {
            $this->error('Estrutura de resposta inesperada.');
            return self::FAILURE;
        }

        Weather::create([
            'city'        => $payload['name'],
            'temperature' => $payload['main']['temp'],
            'humidity'    => $payload['main']['humidity'],
            'condition'   => $payload['weather'][0]['description'],
            'fetched_at'  => now(),
        ]);

        $this->info("Clima salvo: {$payload['name']} → {$payload['main']['temp']} °C");
        return self::SUCCESS;
    }
}
