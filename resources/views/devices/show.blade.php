<!-- resources/views/devices/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 p-6 bg-cover bg-center bg-no-repeat rounded-2xl shadow-lg"
     style="background-image: url('/cardBG/{{ $device->type }}-{{ $device->status }}.png')">
    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xs rounded-xl p-6">

        <div class="flex justify-between items-start mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $device->name }}</h1>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1"><strong>Type:</strong> {{ $device->type }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-300"><strong>Location:</strong> {{ $device->location }}</p>
            </div>
            <span class="px-4 py-1 text-sm font-semibold rounded-full mt-2"
                  class="{{ $device->status == 'on' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                {{ strtoupper($device->status) }}
            </span>
        </div>

        <form action="{{ route('devices.update', $device->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mt-4">
                <button type="submit"
                        class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition">
                    {{ $device->status == 'on' ? 'Turn Off' : 'Turn On' }}
                </button>
            </div>
        </form>

        {{-- Optional: Add graphs or other components here --}}
    </div>
</div>

@endsection
