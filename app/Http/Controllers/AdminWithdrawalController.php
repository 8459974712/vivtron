<?php

namespace App\Http\Controllers;

use App\Models\EmployeePermission;
use App\Models\User;
use App\Models\Withdrawal;

class AdminWithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::with('user')
            ->latest()
            ->get();

        return view('admin.withdrawals', compact('withdrawals'));
    }

    public function approve($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status == 'pending') {

            $user = User::find($withdrawal->user_id);

            $user->wallet_balance -= $withdrawal->amount;
            $user->save();

            $withdrawal->status = 'approved';
            $withdrawal->save();
        }

        return back()->with('success', 'Withdrawal Approved');
    }

    public function reject($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        $withdrawal->status = 'rejected';
        $withdrawal->save();

        return back()->with('success', 'Withdrawal Rejected');
    }
}