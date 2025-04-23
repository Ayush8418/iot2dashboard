<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Smart Home Dashboard') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Londrina+Outline&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Londrina+Solid&display=swap" rel="stylesheet">

    <!-- Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <!-- Sidebar (Fixed Left) -->
    <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg fixed top-0 left-0 bottom-0 z-20 hidden sm:block">
        <div class="p-6 flex flex-col items-center text-center border-b border-gray-200 dark:border-gray-700">
            <img class="w-32 h-32 rounded-full object-cover shadow-lg shadow-indigo-500/50" src="{{ asset(Auth::user()->profile_picture ?? 'images/man14.png/' . Auth::user()->default_picture) }}" alt="Profile">
            <h2 class="mt-2 text-lg font-semibold text-gray-800 dark:text-gray-100">{{ Auth::user()->name }}</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
        </div>
        <nav class="mt-6 px-4">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('icons/dashboard.png') }}" alt="Dashboard Icon" class="w-4 h-4">
                    <span>{{ __('Dashboard') }}</span>
                </div>
            </x-nav-link>
            <br><br>
            <x-nav-link :href="route('devices.index')" :active="request()->routeIs('dashboard')">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('icons/menu.png') }}" alt="Dashboard Icon" class="w-4 h-4">
                    <span>{{ __('View Devices') }}</span>
                </div>
            </x-nav-link>
            <br><br>
            <x-nav-link :href="route('devices.create')" :active="request()->routeIs('dashboard')">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('icons/add.png') }}" alt="Dashboard Icon" class="w-4 h-4">
                    <span>{{ __('Add Device') }}</span>
                </div>
            </x-nav-link>
            <br><br>
            <x-nav-link :href="route('devices.search')" :active="request()->routeIs('dashboard')">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('icons/search.png') }}" alt="Dashboard Icon" class="w-4 h-4">
                    <span>{{ __('Search Devices') }}</span>
                </div>
            </x-nav-link>
            <br><br>
        </nav>
    </aside>

    <!-- Main Content Area -->
    <div class="ml-64 flex flex-col h-screen">
        <!-- Top Navbar (Fixed) -->
        <header class="bg-white dark:bg-gray-800 shadow px-6 py-4 flex justify-between items-center fixed top-0 left-64 right-0 z-10">
            <div class="flex items-center space-x-3">
                <img src="{{asset('mylogo.png')}}" class="h-12 w-12 mb-0">
                <span class="text-xl font-bold text-gray-800 dark:text-gray-100">Smart Home Dashboard</span>
            </div>
            <div class="flex items-center space-x-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="ms-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414L10 13.414l-4-4a1 1 0 010-1.414z" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.index')">{{ __('Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </header>

        <!-- Main Scrollable Content -->
        <div class="mt-20 px-4 sm:px-6 lg:px-8 overflow-y-auto flex-1">
            @hasSection('header')
                <div class="bg-white dark:bg-gray-800 shadow mb-4">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </div>
            @endif

            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
