@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">All Devices</h1>

    <div class="mb-6">
        <button onclick="showGroup('location')" class="bg-blue-600 text-white px-4 py-2 rounded">Group by Location</button>
        <button onclick="showGroup('type')" class="bg-green-600 text-white px-4 py-2 rounded ml-2">Group by Type</button>
    </div>

    <!-- Group by Location -->
    <div id="group-location" class="group-section">
        @foreach($groupedByLocation as $location => $devices)
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">{{ $location }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($devices as $device)
                        @include('devices.partials.card', ['device' => $device])
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- Group by Type -->
    <div id="group-type" class="group-section hidden">
        @foreach($groupedByType as $type => $devices)
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">{{ ucfirst($type) }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($devices as $device)
                        @include('devices.partials.card', ['device' => $device])
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    function showGroup(type) {
        document.getElementById('group-location').classList.add('hidden');
        document.getElementById('group-type').classList.add('hidden');

        document.getElementById('group-' + type).classList.remove('hidden');
    }
</script>
@endsection
