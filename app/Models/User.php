<?php

namespace App\Models;

use App\Models\Withdrawal;
use App\Models\WalletTransaction;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

  protected $fillable = [
    'name',
    'email',
    'mobile',
    'password',
    'role',
    'referral_code',
    'sponsor_id',
    'status',
    'rank',
    'joining_date',
    'wallet_balance',
    'otp',
'otp_expires_at',
'otp_verified',
'profile_image'
];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {

            $lastUser = User::latest('id')->first();

            $nextId = $lastUser ? $lastUser->id + 1 : 1;

            $user->referral_code = 'VT' . str_pad($nextId, 6, '0', STR_PAD_LEFT);

            $user->joining_date = now();

        });
    }

public function referrals() { return $this->hasMany(User::class, 'sponsor_id'); }

public function kyc()
{
    return $this->hasOne(Kyc::class);
}

public function bankDetail()
{
    return $this->hasOne(BankDetail::class);
}

public function incomes()
{
    return $this->hasMany(Income::class);
}

public function withdrawals()
{
    return $this->hasMany(Withdrawal::class);
}

public function walletTransactions()
{
    return $this->hasMany(WalletTransaction::class);
}

public function sales()
{
    return $this->hasMany(Sale::class);
}

public function sponsor()
{
    return $this->belongsTo(User::class, 'sponsor_id');
}

public function downlines()
{
    return $this->hasMany(User::class, 'sponsor_id');
}

public function employeePermission()
{
    return $this->hasOne(EmployeePermission::class, 'employee_id');
}

public function children()
{
    return $this->hasMany(User::class, 'sponsor_id');
}

public function operationalSales()
{
    return $this->hasMany(Sale::class)
        ->where('status', 'operational');
}

public function chargingStations()
{
    return $this->hasMany(ChargingStation::class);
}

}
