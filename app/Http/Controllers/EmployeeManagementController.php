<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmployeePermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeManagementController extends Controller
{
    public function index()
    {
        $employees = User::where('role', 'employee')->get();

        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $employee = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'employee',
            'status' => 'active',
            'rank' => 'Employee',
            'wallet_balance' => 0,
        ]);

        EmployeePermission::create([
            'employee_id' => $employee->id,

            'users_access' => $request->has('users_access'),
            'kyc_access' => $request->has('kyc_access'),
            'sales_access' => $request->has('sales_access'),
            'income_access' => $request->has('income_access'),
            'withdrawal_access' => $request->has('withdrawal_access'),
            'reward_access' => $request->has('reward_access'),
            'bank_access' => $request->has('bank_access'),
            'rank_access' => $request->has('rank_access'),
            'reward_setting_access' => $request->has('reward_setting_access'),
            'royalty_access' => $request->has('royalty_access'),
            'level_access' => $request->has('level_access'),
            'export_access' => $request->has('export_access'),
        ]);

        return redirect()->route('admin.employees');
    }
}