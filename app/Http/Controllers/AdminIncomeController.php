<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Income;
use Illuminate\Http\Request;

class AdminIncomeController extends Controller
{
    public function index()
    {
        $users = User::all();

        $incomes = Income::latest()->take(50)->get();

        return view('admin.income.index', compact('users', 'incomes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'amount' => 'required|numeric',
            'description' => 'required',
        ]);

        $user = User::findOrFail($request->user_id);

        $user->wallet_balance += $request->amount;
        $user->save();

        Income::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'type' => 'manual_adjustment',
            'description' => $request->description,
        ]);

        return back()->with('success', 'Income Added Successfully');
    }
}