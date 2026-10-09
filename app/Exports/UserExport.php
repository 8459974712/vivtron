<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromCollection
{
    public function collection()
    {
        return User::select(
            'id',
            'name',
            'email',
            'referral_code',
            'sponsor_id',
            'rank',
            'wallet_balance',
            'created_at'
        )->get();
    }
}