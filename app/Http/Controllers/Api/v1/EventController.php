<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\EventApiService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventController extends Controller
{
    /**
     * @var EventApiService $eventApiService
     */
    protected $eventApiService;

    /**
     * Class constructor
     *
     * @param EventApiService $eventApiService
     */
    public function __construct(EventApiService $eventApiService)
    {
        $this->eventApiService = $eventApiService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = $this->eventApiService->index();

        return response()->json($events);
    }

    /**
     * Display active events
     *
     * @return \Illuminate\Http\Response
     */
    public function activeEvents()
    {
        $activeEvents = $this->eventApiService->activeEvents();

        return response()->json($activeEvents);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $event = $this->eventApiService->store($request->validated());

        return response()->json($event, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateEventRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, $id)
    {
        $event = $this->eventApiService->update($id, $request->validated());

        return response()->json($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $this->eventApiService->delete($event);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
