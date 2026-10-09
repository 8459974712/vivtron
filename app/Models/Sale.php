<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'user_id',
        'product_name',
        'sale_value',
        'status',
        'approved_by',
        'operational_date',
        'remarks',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}