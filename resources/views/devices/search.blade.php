@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl mb-6 font-semibold">Search Devices</h1>

    <!-- Search Form -->
    <form action="{{ route('devices.search') }}" method="GET" class="mb-8 flex items-center gap-4">
        <input 
            type="text" 
            name="query" 
            value="{{ request('query') }}" 
            placeholder="Search by name, type, or location"
            class="w-full md:w-1/2 p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
        />
        <button 
            type="submit" 
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Search
        </button>
    </form>

    <!-- Search Results -->
    @if(isset($devices) && count($devices))
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($devices as $device)
                <div class="bg-white p-4 rounded-2xl shadow-md">
                    <h3 class="font-semibold text-lg">{{ $device->name }}</h3>
                    <p class="text-gray-600">Type: {{ $device->type }}</p>
                    <p class="text-gray-600">Location: {{ $device->location }}</p>
                    <p>Status: 
                        <span class="{{ $device->status === 'on' ? 'text-green-600' : 'text-red-600' }} font-bold">
                            {{ strtoupper($device->status) }}
                        </span>
                    </p>

                    <!-- Actions -->
                    <div class="mt-3 flex flex-wrap gap-2">
                        <form action="{{ route('devices.toggle', $device->id) }}" method="POST">
                            @csrf
                            <button class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Toggle</button>
                        </form>
                        <a href="{{ route('devices.edit', $device->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                            Edit
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif(request('query'))
        <p class="text-gray-500 text-center mt-10">No devices found for "<strong>{{ request('query') }}</strong>".</p>
    @endif
</div>
@endsection
