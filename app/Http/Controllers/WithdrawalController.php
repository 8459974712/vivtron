<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Auth::user()
            ->withdrawals()
            ->latest()
            ->get();

        return view('withdrawals.index', compact('withdrawals'));
    }

    public function store(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:200',
    ]);

    $user = Auth::user();

    // KYC Check
    $kyc = $user->kyc;

    if (!$kyc || $kyc->status != 'approved') {
        return back()->with('error', 'KYC Approval Required');
    }

    // Bank Check
    $bank = $user->bankDetail;

    if (!$bank || $bank->status != 'approved') {
        return back()->with('error', 'Bank Approval Required');
    }

    // Wallet Check
    if ($request->amount > $user->wallet_balance) {
        return back()->with('error', 'Insufficient Wallet Balance');
    }

    Withdrawal::create([
        'user_id' => $user->id,
        'amount' => $request->amount,
        'status' => 'pending',
    ]);

    return back()->with('success', 'Withdrawal Request Submitted');
}
}