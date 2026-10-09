<?php

namespace App\Http\Controllers;

use App\Models\EmployeePermission;
use App\Models\RewardSetting;
use Illuminate\Http\Request;

class RewardSettingController extends Controller
{
    public function index()
{
    $permission = EmployeePermission::where('employee_id', auth()->id())->first();

    if (
        auth()->user()->role == 'employee' &&
        (!$permission || !$permission->reward_setting_access)
    ) {
        abort(403, 'Unauthorized Access');
    }

    $rewards = RewardSetting::latest()->get();

    return view('admin.reward-settings.index', compact('rewards'));
}

    public function store(Request $request)
    {
        $request->validate([
            'rank_name' => 'required',
            'required_sales' => 'required|numeric',
            'reward_amount' => 'required|numeric',
        ]);

        RewardSetting::create([
            'rank_name' => $request->rank_name,
            'required_sales' => $request->required_sales,
            'reward_amount' => $request->reward_amount,
            'status' => 1,
        ]);

        return back()->with('success', 'Reward Added Successfully');
    }

    public function edit($id)
{
    $reward = RewardSetting::findOrFail($id);

    return view('admin.reward-settings.edit', compact('reward'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'rank_name' => 'required',
        'required_sales' => 'required|numeric',
        'reward_amount' => 'required|numeric',
    ]);

    $reward = RewardSetting::findOrFail($id);

    $reward->update([
        'rank_name' => $request->rank_name,
        'required_sales' => $request->required_sales,
        'reward_amount' => $request->reward_amount,
    ]);

    return redirect()
        ->route('admin.reward.settings')
        ->with('success', 'Reward Updated Successfully');
}

    public function delete($id)
    {
        RewardSetting::findOrFail($id)->delete();

        return back()->with('success', 'Reward Deleted');
    }
}