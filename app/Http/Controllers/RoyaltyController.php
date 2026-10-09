<?php

namespace App\Http\Controllers;

use App\Models\RoyaltySetting;
use Illuminate\Http\Request;

class RoyaltyController extends Controller
{
    public function index()
    {
        $royalties = RoyaltySetting::latest()->get();

        return view('admin.royalty.index', compact('royalties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'required_sales' => 'required|numeric',
            'percentage' => 'required|numeric',
        ]);

        RoyaltySetting::create([
            'title' => $request->title,
            'required_sales' => $request->required_sales,
            'percentage' => $request->percentage,
            'status' => 1,
        ]);

        return back()->with('success', 'Royalty Added Successfully');
    }

    public function delete($id)
    {
        RoyaltySetting::findOrFail($id)->delete();

        return back()->with('success', 'Royalty Deleted');
    }
}