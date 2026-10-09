<?php

namespace App\Http\Controllers;

use App\Models\Kyc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KycController extends Controller
{
    public function create()
    {
        return view('kyc.create', [
            'kyc' => Auth::user()->kyc,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'aadhaar_number' => 'required|digits:12',
            'aadhaar_front' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'aadhaar_back' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'pan_number' => 'required|string|size:10',
            'pan_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Aadhaar Front Image
        $aadhaarFront = $request->file('aadhaar_front')
            ->store('kyc/aadhaar', 'public');

        // Aadhaar Back Image
        $aadhaarBack = $request->file('aadhaar_back')
            ->store('kyc/aadhaar', 'public');

        // PAN Image
        $panImage = $request->file('pan_image')
            ->store('kyc/pan', 'public');

        Kyc::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'aadhaar_number' => $request->aadhaar_number,
                'aadhaar_front' => $aadhaarFront,
                'aadhaar_back' => $aadhaarBack,
                'pan_number' => strtoupper($request->pan_number),
                'pan_image' => $panImage,
                'status' => 'pending',
            ]
        );

        return redirect()
            ->back()
            ->with('success', 'KYC Submitted Successfully');
    }
}
