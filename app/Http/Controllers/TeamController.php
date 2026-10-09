<?php

namespace App\Http\Controllers;

use App\Models\User;

class TeamController extends Controller
{
    public function index()
    {
        $rootUser = auth()->user();
        $rootUser = User::with(
            'children.children.children.children.children.children'
        )->find(auth()->id());

        return view('team.tree', compact('rootUser'));
    }

public static function matchRank($user, $selectedRank)
{
    $rankData = self::getUserRank($user);

    return $rankData['rank'] == $selectedRank;
}

  public static function getUserRank($user)
{
    $level1Count = $user->children()->count();

    // 0 Member
    if($level1Count == 0){
        return [
            'rank' => 'Pre Sales Executive',
            'color' => '#6b7280' // Gray
        ];
    }

    // 1 ya 2 Member
    if($level1Count < 3){
        return [
            'rank' => 'Pre Sales Executive',
            'color' => '#eab308' // Yellow
        ];
    }

    $qualifiedLegs = 0;

    foreach($user->children as $child){

        if($child->children()->count() >= 3){
            $qualifiedLegs++;
        }

    }

    // Level 1 Complete
    if($qualifiedLegs < 3){
        return [
            'rank' => 'Sales Executive',
            'color' => '#22c55e' // Green
        ];
    }

    // Level 2 Complete
    return [
        'rank' => 'Sr. Sales Executive',
        'color' => '#2563eb' // Blue
    ];
}

public static function rankMatch($user, $selectedRank)
{
    if(!$selectedRank){
        return true;
    }

    $rank = self::getUserRank($user)['rank'];

    return $rank == $selectedRank;
}

}
