<?php

namespace App\Http\Controllers;

use App\Exports\IncomeExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('income.index', compact('incomes'));
    }

    public function export()
{
    return Excel::download(new IncomeExport, 'income-report.xlsx');
}
}