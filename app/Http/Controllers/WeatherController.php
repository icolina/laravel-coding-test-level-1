<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\EventApiService;
use App\Services\WeatherApiService;

class WeatherController extends Controller
{
    /**
     * WeatherApiService $weatherApiService
    */
    protected $weatherApiService;

    /**
     * Class Constructor
     *
     * @param WeatherApiService $weatherApiService
     */
    public function __construct(WeatherApiService $weatherApiService)
    {
        $this->weatherApiService = $weatherApiService;
    }

    /**
     * @return void
     */
    public function index()
    {
        $temperature = $this->weatherApiService->getWeather();

        return view('weather', compact('temperature'));
    }
}
