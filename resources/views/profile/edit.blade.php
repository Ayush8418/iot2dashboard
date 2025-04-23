@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">

        <h2 class="text-2xl font-semibold mb-4">Edit Profile</h2>

        @if(session('status') === 'profile-updated')
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                Profile updated successfully.
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block font-medium">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full border px-3 py-2 rounded" required>
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block font-medium">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full border px-3 py-2 rounded" required>
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Profile Picture -->
            <div class="mb-4">
                <label for="profile_picture" class="block font-medium">Profile Picture</label>
                @if ($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Current Picture" class="w-20 h-20 rounded-full mb-2 object-cover">
                @else
                    <img src="{{ asset('images/man14.png') }}" alt="Default Picture" class="w-20 h-20 rounded-full mb-2 object-cover">
                @endif
                <input type="file" name="profile_picture" id="profile_picture" class="w-full">
                @error('profile_picture')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
