@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl mb-4">Edit Device</h1>

    <form action="{{ route('devices.update', $device->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block">Device Name</label>
            <input type="text" name="name" id="name" value="{{ $device->name }}" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="type" class="block">Device Type</label>
            <input type="text" name="type" id="type" value="{{ $device->type }}" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label for="location" class="block">Device Location</label>
            <input type="text" name="location" id="location" value="{{ $device->location }}" class="w-full p-2 border rounded" required>
        </div>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Update Device
        </button>
    </form>
</div>
@endsection
