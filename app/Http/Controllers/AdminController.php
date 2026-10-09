<?php

namespace App\Http\Controllers;

use App\Exports\WithdrawalExport;
use App\Exports\SalesExport;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Sale;
use App\Models\UserReward;
use App\Models\User;
use App\Models\Kyc;
use App\Models\Income;
use App\Models\Withdrawal;

class AdminController extends Controller
{
    public function dashboard()
    {
       
$users = User::latest()->get();

$totalMembers = User::count();

$pendingKyc = Kyc::where('status', 'pending')->count();

$approvedKyc = Kyc::where('status', 'approved')->count();

$totalIncome = Income::sum('amount');

$totalWithdrawals = Withdrawal::where('status', 'approved')->sum('amount');

$pendingWithdrawals = Withdrawal::where('status', 'pending')->count();

$totalSales = Sale::sum('sale_value');

$pendingSales = Sale::where('status', 'pending')->count();

$operationalSales = Sale::where('status', 'operational')->count();

$totalRewards = UserReward::where('status', 'paid')->count();

$paidRewards = UserReward::where('status', 'paid')->count();

$latestSales = Sale::latest()->take(5)->get();

$latestWithdrawals = Withdrawal::latest()->take(5)->get();
        return view('admin.dashboard', compact(
          'users',
    'totalMembers',
    'pendingKyc',
    'approvedKyc',
    'totalIncome',
    'totalWithdrawals',
    'pendingWithdrawals',
    'totalSales',
    'pendingSales',
    'operationalSales',
    'totalRewards',
    'paidRewards',
    'latestSales',
    'latestWithdrawals'
        ));
    }


public function exportUsers()
{
    return Excel::download(
        new UserExport(),
        'users-report.xlsx'
    );
}

public function toggleUserStatus($id)
{
    $user = User::findOrFail($id);

    if ((int) $user->id === (int) auth()->id()) {
        return back()->with('error', 'You cannot deactivate your own admin account.');
    }

    $user->status = strtolower((string) $user->status) === 'active'
        ? 'inactive'
        : 'active';
    $user->save();

    if (request()->expectsJson()) {
        return response()->json([
            'success' => true,
            'status' => $user->status,
            'message' => $user->name . ' is now ' . ucfirst($user->status) . '.',
        ]);
    }

    return back()->with('success', $user->name . ' is now ' . ucfirst($user->status) . '.');
}

public function exportSales()
{
    return Excel::download(
        new SalesExport(),
        'sales-report.xlsx'
    );
}

public function exportWithdrawals()
{
    return Excel::download(
        new WithdrawalExport(),
        'withdrawal-report.xlsx'
    );
}

}
