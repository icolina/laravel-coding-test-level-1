<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container-fluid">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <div class="rounded">
                        <form action="">
                            <input type="search" name="q" class="rounded mx-3 my-2 w-25" placeholder="Search by id, name, or slug" aria-label="Search" aria-describedby="search-addon" value="{{ Request::get('q') }}"/>
                            <button class="btn btn-primary my-2">Search</button>
                        </form>
                    </div>
                    <div class="float-end">
                        <a href="{{ route('events.create') }}" class="btn btn-success mx-3 my-2">+ Create New Event</a>
                    </div>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 table-responsive-md">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Start At</th>
                            <th scope="col">End At</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Deleted At</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $data)
                            <tr>
                                <th>
                                    <a href="{{ route('events.show', $data) }}" class="text-dark text-decoration-none">{{ $data->id }}</a>
                                </th>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->slug }}</td>
                                <td>{{ $data->startAt }}</td>
                                <td>{{ $data->endAt }}</td>
                                <td>{{ $data->createdAt }}</td>
                                <td>{{ $data->updatedAt }}</td>
                                <td>{{ $data->deletedAt ?? 'Not deleted' }}</td>
                                <td>
                                    <div class="flex flex-row align-content-start">
                                        <a href="{{ route('events.edit', $data) }}" class="btn btn-info mr-2">Edit</a>
                                        @if(empty($data->deletedAt))
                                            <form action="{{ route('events.destroy', $data) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
