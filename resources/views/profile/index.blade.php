@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">

        <!-- Profile Section -->
        <div class="flex items-center space-x-4 mb-6">
            <div>
                @if ($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="w-24 h-24 rounded-full object-cover">
                @else
                    <img src="{{ asset('images/man14.png') }}" alt="Default Profile" class="w-24 h-24 rounded-full object-cover">
                @endif
            </div>
            <div>
                <h2 class="text-2xl font-semibold">{{ $user->name }}</h2>
                <p class="text-gray-600">{{ $user->email }}</p>
                <a href="{{ route('profile.edit') }}" class="inline-block mt-2 px-4 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Edit Profile
                </a>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center mt-6">
            <div class="bg-gray-100 p-4 rounded-lg shadow">
                <p class="text-sm text-gray-500">Devices Added</p>
                <p class="text-xl font-bold">{{ $deviceCount }}</p>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg shadow">
                <p class="text-sm text-gray-500">Rooms Used</p>
                <p class="text-xl font-bold">{{ $roomCount }}</p>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg shadow">
                <p class="text-sm text-gray-500">Total Usage (Hrs)</p>
                <p class="text-xl font-bold">{{ number_format($totalUsage, 2) }}</p>
            </div>
        </div>

    </div>
</div>
@endsection
