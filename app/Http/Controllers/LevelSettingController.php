<?php

namespace App\Http\Controllers;

use App\Models\LevelSetting;
use Illuminate\Http\Request;

class LevelSettingController extends Controller
{
    public function index()
    {
        $levels = LevelSetting::orderBy('level_no')->get();

        return view('admin.level-settings.index', compact('levels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_no' => 'required|numeric',
            'percentage' => 'required|numeric',
        ]);

        LevelSetting::create([
            'level_no' => $request->level_no,
            'percentage' => $request->percentage,
            'status' => 1,
        ]);

        return back()->with('success', 'Level Added Successfully');
    }

    public function delete($id)
    {
        LevelSetting::findOrFail($id)->delete();

        return back()->with('success', 'Level Deleted Successfully');
    }
}