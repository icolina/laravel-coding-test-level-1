<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container-fluid">
            <form action="{{ route('events.update', $event) }}" method="PUT">
                @csrf

                <div class="bg-white overflow-hidden shadow-sm p-4">
                    <div class="p-6 bg-white">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter New Name" value="{{ $event->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter New Slug" value="{{ $event->slug }}">
                        </div>
                        <p>Slug: {{ $event->slug }}</p>
                        <p>Start At: {{ $event->startAt }}</p>
                        <p>End At: {{ $event->endAt }}</p>
                        <p>Created At: {{ $event->createdAt }}</p>
                        <p>Updated At: {{ $event->updatedAt }}</p>
                        <p>Deleted At: {{ $event->deletedAt ?? 'Not Deleted' }}</p>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="{{ route('events.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
