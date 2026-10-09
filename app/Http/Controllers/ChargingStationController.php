<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\ChargingStation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChargingStationController extends Controller
{
    private const OCCUPIED_RADIUS_METERS = 100;

    public function index()
    {
        $occupiedStations = ChargingStation::active()
            ->latest()
            ->get(['id', 'station_name', 'address', 'latitude', 'longitude', 'created_at']);

        $myStations = auth()->user()->chargingStations()->latest()->get();
        $mapToken = AppSetting::valueFor('mappls_access_token');

        return view('stations.index', compact('occupiedStations', 'myStations', 'mapToken'));
    }

    public function markers(): JsonResponse
    {
        return response()->json(
            ChargingStation::active()
                ->get(['id', 'station_name', 'address', 'latitude', 'longitude'])
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'station_name' => ['nullable', 'string', 'max:120'],
            'address' => ['nullable', 'string', 'max:1000'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
        ]);

        $nearby = ChargingStation::active()
            ->get(['id', 'latitude', 'longitude'])
            ->first(fn (ChargingStation $station) => $this->distanceInMeters(
                (float) $data['latitude'],
                (float) $data['longitude'],
                (float) $station->latitude,
                (float) $station->longitude
            ) < self::OCCUPIED_RADIUS_METERS);

        if ($nearby) {
            return back()
                ->withInput()
                ->with('error', 'This location is already occupied. Please choose a location at least 100 meters away.');
        }

        $request->user()->chargingStations()->create([
            ...$data,
            'status' => 'active',
        ]);

        return back()->with('success', 'Recharge station location registered successfully.');
    }

    public function reverseGeocode(Request $request): JsonResponse
    {
        $data = $request->validate([
            'lat' => ['required', 'numeric', 'between:-90,90'],
            'lng' => ['required', 'numeric', 'between:-180,180'],
        ]);

        $token = AppSetting::valueFor('mappls_access_token');

        if (!$token) {
            return response()->json(['message' => 'Mappls token is not configured yet.'], 422);
        }

        $response = Http::timeout(8)->get('https://search.mappls.com/search/address/rev-geocode', [
            'lat' => $data['lat'],
            'lng' => $data['lng'],
            'access_token' => $token,
        ]);

        if (!$response->successful()) {
            return response()->json(['message' => 'Unable to fetch the address from Mappls.'], 502);
        }

        return response()->json([
            'address' => data_get($response->json(), 'results.0.formatted_address'),
        ]);
    }

    private function distanceInMeters(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $earthRadius = 6371000;
        $latDelta = deg2rad($lat2 - $lat1);
        $lngDelta = deg2rad($lng2 - $lng1);
        $a = sin($latDelta / 2) ** 2
            + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($lngDelta / 2) ** 2;

        return 2 * $earthRadius * asin(min(1, sqrt($a)));
    }
}
