<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class EventApiService
{

    /**
     * @param Bool        $paginated
     * @param String|null $search
     * @param Int         $paginate
     * @return mixed
     */
    public function index(Bool $paginated = false, String $search = null, Int $paginate = 5) : Collection | LengthAwarePaginator | Array
    {
        $page = Request::capture()->get('page', 1);

        return Cache::remember("events-$search-$page", 60, function () use ($paginated, $search, $paginate) {
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
        });
    }

    /**
     *
     * @param String|null $search
     * @param Int         $paginate
     * @return mixed
     */
    public function indexWithPagination(?String $search = null, Int $paginate = 5)
    {
        return $this->index(true, $search, $paginate);
    }

    /**
     * @return mixed
     */
    public function activeEvents() : Collection | Array
    {
        $dateNow = now()->addDays()->toDateTimeString();

        return Cache::remember(
            'active-events',
            60,
            fn() => Event::query()
                        ->whereRaw('? between startAt and endAt', [$dateNow])
                        ->get()
        );
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
