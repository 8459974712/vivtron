<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kyc;
use App\Models\Sale;
use App\Models\Withdrawal;
use App\Models\EmployeePermission;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        $permission = EmployeePermission::where(
            'employee_id',
            auth()->id()
        )->first();

        $totalUsers = User::count();
        $pendingKyc = Kyc::where('status', 'pending')->count();
        $pendingSales = Sale::where('status', 'pending')->count();
        $pendingWithdrawals = Withdrawal::where('status', 'pending')->count();

        return view('employee.dashboard', compact(
            'permission',
            'totalUsers',
            'pendingKyc',
            'pendingSales',
            'pendingWithdrawals'
        ));
    }
}