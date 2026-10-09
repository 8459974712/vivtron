<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoyaltySetting extends Model
{
    protected $fillable = [
        'title',
        'required_sales',
        'percentage',
        'status',
    ];
}