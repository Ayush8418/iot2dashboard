<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;
use App\Models\Device;
use App\Models\DeviceUsage; // assuming you're tracking usage
use Carbon\Carbon;

class DashboardController extends Controller
{
//     public function index(Request $request)
// {
//     // Try to get the IP (will be 127.0.0.1 locally)
//     $ip = $request->ip();

//     // Get location info (might return null)
//     $position = Location::get($ip);

//     // Set default city
//     $city = 'Delhi';

//     // If city is available, use it
//     if ($position && property_exists($position, 'city') && $position->city !== null) {
//         $city = $position->city;
//     }
//     $ip = request()->ip(); // gets the user's IP

//     $locationData = @json_decode(file_get_contents("http://ip-api.com/json/{$ip}"), true);

//     $city = $locationData && isset($locationData['city']) ? $locationData['city'] : 'Delhi'; // fallback to Delhi

//     // Weather API
//     $apiKey = 'de5b00dc9ded713c834010930c99cf5e';  // Replace with your actual OpenWeatherMap API key
//     $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

//     $response = Http::get($url);
//     $weather = $response->json();

//     return view('dashboard', compact('weather'));
// }

public function index(Request $request)
    {
        $ip = request()->ip();
        $locationData = @json_decode(file_get_contents("http://ip-api.com/json/{$ip}"), true);
        $city = $locationData && isset($locationData['city']) ? $locationData['city'] : 'Delhi';

        // Weather API
        $apiKey = 'de5b00dc9ded713c834010930c99cf5e';
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

        $response = Http::get($url);
        $weather = $response->json();

        // 👉 Fetch devices from DB
        // $devices = Device::all();
        $userId = auth()->id(); // ✅ Correct
        $devices = Device::where('user_id', $userId)->get();

        // Let's assume device_id 1 is AC, and 2 is Heater
        // $startDate = Carbon::now()->subDays(9);
        // $labels = [];
        // $acData = [];
        // $heaterData = [];

        // for ($i = 0; $i < 10; $i++) {
        //     $date = $startDate->copy()->addDays($i)->toDateString();
        //     $labels[] = Carbon::parse($date)->format('M d');

        //     $acUsage = DeviceUsage::where('device_id', 1)->where('date', $date)->sum('hours_used');
        //     $heaterUsage = DeviceUsage::where('device_id', 2)->where('date', $date)->sum('hours_used');

        //     $acData[] = $acUsage;
        //     $heaterData[] = $heaterUsage;
        // }

        // // Build data for the chart
        // $comboChartData = [['Day', 'AC', 'Heater']];
        // foreach ($labels as $i => $label) {
        //     $comboChartData[] = [$label, $acData[$i], $heaterData[$i]];
        // }
        $comboChartData = [
            ['Date', 'AC', 'Heater', 'Average'],
            ['Apr 8', 2, 3, 2.5],
            ['Apr 9', 1, 4, 2.5],
            ['Apr 10', 3, 2, 2.5],
            ['Apr 11', 2, 2, 2],
            ['Apr 12', 4, 1, 2.5],
            ['Apr 13', 3, 3, 3],
            ['Apr 14', 2, 1, 1.5],
            ['Apr 15', 4, 5, 4.5],
            ['Apr 16', 3, 2, 2.5],
            ['Apr 17', 5, 3, 4],
        ];
        $devicesJson = $devices->map(function($d) {
            return [
                'id' => $d->id,
                'name' => $d->name,
                'type' => $d->type,
                'room' => $d->location,
                'status' => $d->status
            ];
        });
        return view('dashboard', compact('devices', 'comboChartData', 'weather', 'devicesJson'));
        

        // return view('dashboard', compact('weather', 'devices', 'comboChartData'));
    }

}


