<?php

namespace App\Http\Controllers;

use App\Models\EmployeePermission;
use App\Models\RoyaltySetting;
use App\Models\UserRoyalty;
use App\Models\LevelSetting;
use App\Models\ReferralPoint;
use App\Models\RankSetting;
use App\Models\RewardSetting;
use App\Models\UserReward;
use App\Models\Income;
use Illuminate\Support\Facades\Auth;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
{
    $permission = EmployeePermission::where('employee_id', auth()->id())->first();

    if (
        auth()->user()->role == 'employee' &&
        (!$permission || !$permission->sales_access)
    ) {
        abort(403, 'Unauthorized Access');
    }

    $sales = Sale::latest()->get();
    $users = User::all();

    return view('admin.sales.index', compact('sales', 'users'));
}

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'sale_value' => 'required|numeric',
        ]);

        Sale::create([
            'user_id' => $request->user_id,
            'product_name' => $request->product_name,
            'sale_value' => $request->sale_value,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Sale Added Successfully');
    }


    public function approve($id)
{
    $sale = Sale::findOrFail($id);
 if ($sale->status != 'pending') {
        return back()->with('error', 'Only Pending Sales can be Approved');
    }
    $sale->status = 'approved';
    $sale->approved_by = Auth::id();
    $sale->save();

    return back()->with('success', 'Sale Approved');
}

public function reject($id)
{
    $sale = Sale::findOrFail($id);
 if ($sale->status == 'operational') {
        return back()->with('error', 'Operational Sale cannot be Rejected');
    }

    $sale->status = 'rejected';
    $sale->save();

    return back()->with('success', 'Sale Rejected');
}

public function operational($id)
{
    $sale = Sale::findOrFail($id);

    if ($sale->status == 'operational') {
        return back()->with('error', 'Sale already operational');
    }

    if ($sale->status != 'approved') {
        return back()->with('error', 'Only Approved Sales can become Operational');
    }


    $sale->status = 'operational';
    $sale->operational_date = now();
    $sale->save();

   $levels = LevelSetting::where('status', 1)
    ->orderBy('level_no')
    ->get();

    $buyer = User::find($sale->user_id);

    ReferralPoint::create([
    'user_id' => $buyer->id,
    'sale_id' => $sale->id,
    'points' => $sale->sale_value,
    'type' => 'sale_point',
    'description' => 'Points earned from Sale #' . $sale->id,
]);

    $currentSponsorId = $buyer->sponsor_id;

   foreach ($levels as $level) {

    if (!$currentSponsorId) {
        break;
    }

    $upline = User::find($currentSponsorId);

    if (!$upline) {
        break;
    }

    $incomeAmount = ($sale->sale_value * $level->percentage) / 100;

    $upline->wallet_balance += $incomeAmount;
    $upline->save();

    Income::create([
        'user_id' => $upline->id,
        'amount' => $incomeAmount,
        'type' => 'level_income',
        'description' => 'Level ' . $level->level_no . ' Income From Sale #' . $sale->id,
    ]);

    $currentSponsorId = $upline->sponsor_id;
}

    $operationalSales = Sale::where('user_id', $buyer->id)
    ->where('status', 'operational')
    ->count();

$rewards = RewardSetting::where('status', 1)->get();

foreach ($rewards as $reward) {

    if ($operationalSales >= $reward->required_sales) {

        $exists = UserReward::where('user_id', $buyer->id)
            ->where('reward_setting_id', $reward->id)
            ->exists();

        if (!$exists) {

            UserReward::create([
                'user_id' => $buyer->id,
                'reward_setting_id' => $reward->id,
                'achieved_on' => now(),
                'status' => 'pending',
            ]);
        }
    }
}

$operationalSales = Sale::where('user_id', $buyer->id)
    ->where('status', 'operational')
    ->count();

$rank = RankSetting::where('status', 1)
    ->where('required_sales', '<=', $operationalSales)
    ->orderByDesc('required_sales')
    ->first();

if ($rank) {

    $buyer->rank = $rank->rank_name;

    $buyer->save();
}


$royalties = RoyaltySetting::where('status', 1)->get();

foreach ($royalties as $royalty) {

    if ($operationalSales >= $royalty->required_sales) {

        $exists = UserRoyalty::where('user_id', $buyer->id)
            ->where('royalty_setting_id', $royalty->id)
            ->exists();

        if (!$exists) {

            $royaltyAmount = ($sale->sale_value * $royalty->percentage) / 100;

            $buyer->wallet_balance += $royaltyAmount;
            $buyer->save();

            Income::create([
                'user_id' => $buyer->id,
                'amount' => $royaltyAmount,
                'type' => 'royalty_income',
                'description' => $royalty->title . ' Royalty Income',
            ]);

            UserRoyalty::create([
                'user_id' => $buyer->id,
                'royalty_setting_id' => $royalty->id,
                'amount' => $royaltyAmount,
                'achieved_on' => now(),
                'status' => 'paid',
            ]);
        }
    }
}

    return back()->with('success', 'Sale marked Operational & Income Distributed');
}
}