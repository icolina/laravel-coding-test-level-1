<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\EventApiService;
use App\Services\WeatherApiService;

class WeatherController extends Controller
{
    protected $weatherApiService;

    /**
     * @param WeatherApiService $weatherApiService
     */
    public function __construct(WeatherApiService $weatherApiService)
    {
        $this->weatherApiService = $weatherApiService;
    }

    public function index()
    {
        $temperature = $this->weatherApiService->getWeather();

        return view('weather', compact('temperature'));
    }
}
