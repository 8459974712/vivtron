<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralPoint extends Model
{
    protected $fillable = [
        'user_id',
        'sale_id',
        'points',
        'type',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}