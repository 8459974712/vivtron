<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kyc extends Model
{
    protected $fillable = [
        'user_id',
        'aadhaar_number',
        'pan_number',
        'aadhaar_front',
        'aadhaar_back',
        'pan_image',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
