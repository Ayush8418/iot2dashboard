<div 
    class="relative p-6 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 bg-cover bg-center bg-no-repeat">
    <!-- Center-right Icon -->
    <img 
        src="{{ asset('cardBG/' . $device->type . '.png') }}" 
        alt="Device Icon" 
        class="absolute top-1/2 left-[65%] transform -translate-y-1/2 w-16 h-16 opacity-90"
    />

    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xs rounded-xl p-4 
                {{ $device->status === 'on' ? 'bg-yellow-100' : 'bg-white/80' }}">
        
        <div class="flex justify-between items-start">
            <div>
                <h3 class="font-bold text-xl text-gray-800 dark:text-white">{{ $device->name }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300">Type: {{ $device->type }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-300">Location: {{ $device->location }}</p>
            </div>
            <span class="px-3 py-1 text-sm font-semibold rounded-full
                        {{ $device->status === 'on' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                {{ strtoupper($device->status) }}
            </span>
        </div>

        <div class="mt-4 flex flex-wrap gap-2">
            <form action="{{ route('devices.toggle', $device->_id) }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg">
                    Toggle
                </button>
            </form>
            <a href="{{ route('devices.edit', $device->_id) }}" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg">
                Edit
            </a>
            <form action="{{ route('devices.destroy', $device->_id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this device?')" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
