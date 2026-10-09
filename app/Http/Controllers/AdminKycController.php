<?php

namespace App\Http\Controllers;

use App\Models\Kyc;

class AdminKycController extends Controller
{
    public function index()
    {
        $kycs = Kyc::with('user')->latest()->get();

        return view('admin.kycs', compact('kycs'));
    }

    public function approve($id)
    {
        $kyc = Kyc::findOrFail($id);

        $kyc->update([
            'status' => 'approved'
        ]);

        return back()->with('success', 'KYC Approved');
    }

    public function reject($id)
    {
        $kyc = Kyc::findOrFail($id);

        $kyc->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', 'KYC Rejected');
    }
}