<?php

namespace App\Http\Controllers;

use App\Models\BankDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankDetailController extends Controller
{
    public function create()
    {
        return view('bank.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_holder_name' => 'required',
            'bank_name' => 'required',
            'account_number' => 'required',
            'ifsc_code' => 'required',
        ]);

        BankDetail::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'account_holder_name' => $request->account_holder_name,
                'bank_name' => $request->bank_name,
                'account_number' => $request->account_number,
                'ifsc_code' => $request->ifsc_code,
                'status' => 'pending',
            ]
        );

        return back()->with('success', 'Bank Details Submitted Successfully');
    }
}