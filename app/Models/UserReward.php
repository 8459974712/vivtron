<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReward extends Model
{
    protected $fillable = [
        'user_id',
        'reward_setting_id',
        'achieved_on',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reward()
    {
        return $this->belongsTo(RewardSetting::class, 'reward_setting_id');
    }
}