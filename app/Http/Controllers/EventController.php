<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Services\EventApiService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $eventApiService;

    public function __construct(EventApiService $eventApiService)
    {
        $this->eventApiService = $eventApiService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search   = $request->get('q');
        $events   = $this->eventApiService->indexWithPagination($search);

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
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

        return redirect()->route('events.create', $event)->with('success', 'Event successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateEventRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, String $uuid)
    {
        $event = $this->eventApiService->update($uuid, $request->validated());

        return redirect()->route('events.show', $event)->with('success', 'Event successfully updated!');
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

        return redirect()->route('events.index')->with('success', 'Event successfully deleted!');
    }
}
