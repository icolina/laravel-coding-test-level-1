<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container-fluid">
            <form action="{{ route('events.store') }}" method="POST">
                @csrf

                <div class="bg-white overflow-hidden shadow-sm p-4">
                    <div class="p-6 bg-white">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Slug">
                        </div>
                        <div class="mb-3">
                            <label for="startAt" class="form-label">Start At</label>
                            <input type="datetime-local" class="form-control" id="startAt" name="startAt">
                        </div>
                        <div class="mb-3">
                            <label for="endAt" class="form-label">End At</label>
                            <input type="datetime-local" class="form-control" id="endAt" name="endAt">
                        </div>
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
