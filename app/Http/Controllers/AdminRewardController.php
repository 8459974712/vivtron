<?php

namespace App\Http\Controllers;

use App\Models\UserReward;

class AdminRewardController extends Controller
{
    public function index()
    {
        $rewards = UserReward::with(['user', 'reward'])
            ->latest()
            ->get();

        return view('admin.rewards.index', compact('rewards'));
    }

    public function approve($id)
    {
        $reward = UserReward::findOrFail($id);

        $reward->status = 'approved';
        $reward->save();

        return back()->with('success', 'Reward Approved');
    }

    public function paid($id)
    {
        $reward = UserReward::findOrFail($id);

        $reward->status = 'paid';
        $reward->save();

        return back()->with('success', 'Reward Marked Paid');
    }
}