<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class EventApiService
{
    /**
     * @return mixed
     */
    public function index() : Collection | Array
    {
        return Event::all();
    }

    /**
     * @return mixed
     */
    public function activeEvents() : Collection | Array
    {
        $dateNow      = now()->addDays()->toDateTimeString();
        $activeEvents = Event::whereRaw('? between startAt and endAt', [$dateNow])
                            ->get();

        return $activeEvents;
    }

    /**
     * @param Array $data
     *
     * @return mixed
     */
    public function store(Array $data) : Model | Event
    {
        $data['slug'] = Str::slug(Arr::get($data, 'slug'));

        return Event::create($data);
    }

    /**
     * @param String $uuid
     * @param Array $data
     *
     * @return void
     */
    public function update(String $uuid, Array $data) : Model | Event
    {
        $data['slug'] = Str::slug(Arr::get($data, 'slug'));

        return Event::updateOrCreate([
            'id' => $uuid
        ], $data);
    }

    /**
     * @param Event $event
     *
     * @return void
     */
    public function delete(Event $event) : void
    {
        $event->delete();
    }
}

?>
