<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
{
    // public function index()
    // {
    //     $devices = Device::where('user_id', Auth::id())->get();
    //     return view('devices.index', compact('devices'));
    // }
    public function index()
    {
        // $devices = \App\Models\Device::all();
        $devices = Device::where('user_id', auth()->id())->get();
        // Group by place (location) and type
        $groupedByLocation = $devices->groupBy('location');
        $groupedByType = $devices->groupBy('type');

        return view('devices.index', compact('devices', 'groupedByLocation', 'groupedByType'));
    }



    public function create()
    {
        return view('devices.create');
    }

    public function store(Request $request)
    {
        Device::create([
            'name' => $request->name,
            'type' => $request->type,
            'location' => $request->location,
            'status' => 'off',
            'user_id' => Auth::id()
        ]);

        return redirect()->route('dashboard')->with('success', 'Device added!');
    }

    public function show($id)
    {
        $device = Device::findOrFail($id);
        return view('devices.show', compact('device'));
    }

    public function edit($id)
    {
        $device = Device::findOrFail($id);
        return view('devices.edit', compact('device'));
    }

    public function update(Request $request, $id)
    {
        $device = Device::findOrFail($id);

        $device->update([
            'name' => $request->name,
            'type' => $request->type,
            'location' => $request->location,
        ]);

        return redirect()->route('dashboard')->with('success', 'Device updated successfully!');
    }


    public function destroy($id)
    {
        Device::findOrFail($id)->delete();
        return redirect()->route('dashboard')->with('success', 'Device removed!');
    }

    public function toggle($id)
    {
        $device = Device::findOrFail($id);
        $device->status = $device->status === 'on' ? 'off' : 'on';
        $device->save();

        return redirect()->back();
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $devices = Device::where('name', 'like', "%{$search}%")
            ->orWhere('type', 'like', "%{$search}%")
            ->orWhere('location', 'like', "%{$search}%")
            ->get();

        return view('devices.search', compact('devices', 'search'));
    }

}
