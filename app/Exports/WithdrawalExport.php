<?php

namespace App\Exports;

use App\Models\Withdrawal;
use Maatwebsite\Excel\Concerns\FromCollection;

class WithdrawalExport implements FromCollection
{
    public function collection()
    {
        return Withdrawal::latest()->get();
    }
}