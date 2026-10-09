<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelSetting extends Model
{
    protected $fillable = [
        'level_no',
        'percentage',
        'status',
    ];
}