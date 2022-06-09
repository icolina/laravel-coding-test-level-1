<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class EventApiService
{

    public function index(Bool $paginated = false, String $search = null, Int $paginate = 5) : Collection | LengthAwarePaginator | Array
    {
        $events = Event::query()
                        ->when(
                            $search,
                            function (Builder $query, $search) {
                                $query->where(function (Builder $query2) use ($search) {
                                        $query2->where('id', 'like', "%$search%")
                                                ->orWhere('name', 'like', "%$search%")
                                                ->orWhere('slug', 'like', "%$search%");
                                });
                            }
                        )
                        ->latest('createdAt');

        if ($paginated) {
            return $events->paginate($paginate);
        }

        return $events->get();
    }

    public function indexWithPagination(?String $search = null, Int $paginate = 5)
    {
        return $this->index(true, $search, $paginate);
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
