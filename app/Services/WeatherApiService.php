<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherApiService
{
    public function getWeather()
    {
        $data = Http::get('https://api.weatherapi.com/v1/current.json', [
            'key'   => env('WEATHER_API_KEY'),
            'q'     => 'Cebu City',
            'aqi'   => 'no'
        ]);

        $temperatures = json_decode($data->body());

        if (isset($temperatures->error)) {
            Log::error('Place not found!');
        }

        $data = [
            'temperature'   => $temperatures->current->temp_c ? $temperatures->current->temp_c : 0,
            'region'        => $temperatures->location->name,
            'city'          => $temperatures->location->region,
            'country'       => $temperatures->location->country,
            'cloud'         => $temperatures->current->condition->text,
            'img'           => $temperatures->current->condition->icon
        ];

        return $data;
    }
}

?>
