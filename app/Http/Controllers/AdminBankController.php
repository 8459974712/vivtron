<?php

namespace App\Http\Controllers;

use App\Models\BankDetail;
use App\Models\EmployeePermission;

class AdminBankController extends Controller
{
   public function index()
{
    $permission = EmployeePermission::where('employee_id', auth()->id())->first();

    if (
        auth()->user()->role == 'employee' &&
        (!$permission || !$permission->bank_access)
    ) {
        abort(403, 'Unauthorized Access');
    }

    $banks = BankDetail::with('user')->latest()->get();

    return view('admin.banks.index', compact('banks'));
}

    public function approve($id)
    {
        $bank = BankDetail::findOrFail($id);

        $bank->status = 'approved';
        $bank->save();

        return back()->with('success', 'Bank Approved');
    }

    public function reject($id)
    {
        $bank = BankDetail::findOrFail($id);

        $bank->status = 'rejected';
        $bank->save();

        return back()->with('success', 'Bank Rejected');
    }

    
}