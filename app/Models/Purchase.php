<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [

        'user_id',
        'product_id',

        'full_name',
        'email',
        'mobile',
        'pan_number',
        'gst_number',

        'sponsor_id',
        'enroll_id',
        'state',

        'payment_method',
        'payer_name',
        'bank_name',
        'account_number',
        'transaction_number',
        'payment_date',
        'payment_amount',
        'payment_type',

        'slip',

        'amount',

        'status'
    ];

    public function product()
{
    return $this->belongsTo(Product::class);
}


}