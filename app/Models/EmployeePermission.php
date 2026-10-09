<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeePermission extends Model
{
    protected $fillable = [
        'employee_id',
        'users_access',
        'kyc_access',
        'sales_access',
        'income_access',
        'withdrawal_access',
        'reward_access',
        'bank_access',
        'rank_access',
        'reward_setting_access',
        'royalty_access',
        'level_access',
        'export_access',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}