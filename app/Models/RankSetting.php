<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RankSetting extends Model
{
    protected $fillable = [
        'rank_name',
        'required_sales',
        'incentive_percentage',
        'status',
    ];
}