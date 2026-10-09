<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRoyalty extends Model
{
    protected $fillable = [
        'user_id',
        'royalty_setting_id',
        'amount',
        'achieved_on',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function royalty()
    {
        return $this->belongsTo(RoyaltySetting::class, 'royalty_setting_id');
    }
}