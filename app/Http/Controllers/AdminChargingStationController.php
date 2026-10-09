<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\ChargingStation;
use Illuminate\Http\Request;

class AdminChargingStationController extends Controller
{
    public function index()
    {
        $stations = ChargingStation::with('user')->latest()->get();
        $mapToken = AppSetting::valueFor('mappls_access_token');

        return view('admin.stations.index', compact('stations', 'mapToken'));
    }

    public function updateMapplsToken(Request $request)
    {
        $data = $request->validate([
            'mappls_access_token' => ['nullable', 'string', 'max:500'],
        ]);

        if (filled($data['mappls_access_token'] ?? null)) {
            AppSetting::put('mappls_access_token', trim($data['mappls_access_token']));
        } else {
            AppSetting::where('key', 'mappls_access_token')->delete();
        }

        return back()->with('success', 'Mappls settings updated successfully.');
    }

    public function toggle(Request $request, ChargingStation $station)
    {
        $data = $request->validate([
            'status' => ['required', 'in:active,inactive'],
        ]);

        $station->update(['status' => $data['status']]);

        return back()->with('success', 'Station status updated successfully.');
    }
}
