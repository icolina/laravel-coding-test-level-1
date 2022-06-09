<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Weather Temperature') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>
                                <img src="{{ $temperature['img'] }}" class="img-responsive"/>
                                {{ $temperature['temperature'] }}
                                ({{ $temperature['cloud'] }})
                            </h3>
                            <div>
                                {{ $temperature['region'] }}, {{ $temperature['city'] }}, {{ $temperature['country'] }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>

        </div>
    </div>
</x-app-layout>
