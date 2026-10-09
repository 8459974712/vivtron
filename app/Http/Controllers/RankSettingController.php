<?php

namespace App\Http\Controllers;

use App\Models\RankSetting;
use Illuminate\Http\Request;

class RankSettingController extends Controller
{
    public function index()
    {
        $ranks = RankSetting::latest()->get();

        return view('admin.ranks.index', compact('ranks'));
    }
}