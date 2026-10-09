<?php

use App\Http\Controllers\EmployeeManagementController;
use App\Http\Controllers\RoyaltyController;
use App\Http\Controllers\AdminIncomeController;
use App\Http\Controllers\LevelSettingController;
use App\Http\Controllers\RewardSettingController;
use App\Http\Controllers\RankSettingController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminRewardController;
use App\Http\Controllers\AdminBankController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\AdminWithdrawalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KycController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Sale;
use App\Http\Controllers\BankDetailController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminKycController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ChargingStationController;
use App\Http\Controllers\AdminChargingStationController;


Route::middleware(['auth'])->group(function () {

Route::get('/purchase/{id}/remaining', [PurchaseController::class, 'remainingForm'])
    ->name('purchase.remaining.form');

Route::post('/purchase/{id}/remaining', [PurchaseController::class, 'remainingStore'])
    ->name('purchase.remaining.store');

    Route::get('/purchase', [PurchaseController::class,'create'])
        ->name('purchase.create');

    Route::post('/purchase', [PurchaseController::class,'store'])
        ->name('purchase.store');

        Route::get('/purchase/payment/{product}', [PurchaseController::class,'payment'])
    ->name('purchase.payment');

Route::post('/purchase/save', [PurchaseController::class,'savePurchase'])
    ->name('purchase.save');

    Route::get('/my-purchases', [PurchaseController::class, 'myPurchases'])
    ->name('purchase.list');

    Route::get('/admin/purchases', [PurchaseController::class, 'adminPurchases'])
    ->name('admin.purchases');

Route::get('/admin/purchase/{id}/approve', [PurchaseController::class, 'approvePurchase'])
    ->name('purchase.approve');

Route::get('/admin/purchase/{id}/reject', [PurchaseController::class, 'rejectPurchase'])
    ->name('purchase.reject');

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $user = auth()->user();

    $directReferrals = User::where('sponsor_id', $user->id)->count();

   // LEVEL 1
$level1Ids = User::where('sponsor_id', $user->id)->pluck('id');
$level1Count = $level1Ids->count();

// LEVEL 2
$level2Ids = User::whereIn('sponsor_id', $level1Ids)->pluck('id');
$level2Count = $level2Ids->count();

// LEVEL 3
$level3Ids = User::whereIn('sponsor_id', $level2Ids)->pluck('id');
$level3Count = $level3Ids->count();

// LEVEL 4
$level4Ids = User::whereIn('sponsor_id', $level3Ids)->pluck('id');
$level4Count = $level4Ids->count();

// LEVEL 5
$level5Ids = User::whereIn('sponsor_id', $level4Ids)->pluck('id');
$level5Count = $level5Ids->count();

// LEVEL 6
$level6Ids = User::whereIn('sponsor_id', $level5Ids)->pluck('id');
$level6Count = $level6Ids->count();

// LEVEL 7
$level7Ids = User::whereIn('sponsor_id', $level6Ids)->pluck('id');
$level7Count = $level7Ids->count();

// LEVEL 8
$level8Ids = User::whereIn('sponsor_id', $level7Ids)->pluck('id');
$level8Count = $level8Ids->count();

// LEVEL 9
$level9Ids = User::whereIn('sponsor_id', $level8Ids)->pluck('id');
$level9Count = $level9Ids->count();

// LEVEL 10
$level10Ids = User::whereIn('sponsor_id', $level9Ids)->pluck('id');
$level10Count = $level10Ids->count();

$level1Users = User::where('sponsor_id', $user->id)
    ->with('referrals')
    ->get();

    foreach ($level1Users as $member) {

    $member->sales_count = Sale::where('user_id', $member->id)
        ->where('status', 'operational')
        ->count();

}

    $networkTree = User::with([
    'referrals.referrals.referrals.referrals.referrals.referrals.referrals.referrals.referrals.referrals'
])->find($user->id);

    $totalTeam = User::where('sponsor_id', $user->id)->count();

    $referrals = User::where('sponsor_id', $user->id)
                    ->latest()
                    ->get();

    $totalPoints = \App\Models\ReferralPoint::where(
        'user_id',
        $user->id
    )->sum('points');

    $totalIncome = $user->incomes()->sum('amount');

    $walletBalance = $user->wallet_balance;

    $operationalSales = \App\Models\Sale::where('user_id', $user->id)
                        ->where('status', 'operational')
                        ->count();

                        // Self Sales

                        // Self Sales = Direct Joinings
$selfSales = $directReferrals;

// Team Sales (Level 1 se Level 10 tak)
$allTeamIds = collect()
    ->merge($level1Ids)
    ->merge($level2Ids)
    ->merge($level3Ids)
    ->merge($level4Ids)
    ->merge($level5Ids)
    ->merge($level6Ids)
    ->merge($level7Ids)
    ->merge($level8Ids)
    ->merge($level9Ids)
    ->merge($level10Ids)
    ->unique();

$teamSales = \App\Models\Sale::whereIn('user_id', $allTeamIds)
            ->where('status', 'operational')
            ->count();

$totalSales = $selfSales + $teamSales;

// Total Team Business
$totalBusiness = $level1Count
                + $level2Count
                + $level3Count
                + $level4Count
                + $level5Count
                + $level6Count
                + $level7Count
                + $level8Count
                + $level9Count
                + $level10Count;

                $totalTeam = $totalBusiness;

                $getTeamBusiness = function ($userId) use (&$getTeamBusiness) {

    $children = User::where('sponsor_id', $userId)->get();

    $count = $children->count();

    foreach ($children as $child) {
        $count += $getTeamBusiness($child->id);
    }

    return $count;
};

$legs = [];

foreach ($level1Users as $member) {

    $legs[$member->id] = $getTeamBusiness($member->id);

}


$topLegBusiness = !empty($legs) ? max($legs) : 0;

$otherBusiness = $totalBusiness - $topLegBusiness;

// Rank-wise valid business
$validBusiness9 = min($topLegBusiness, 3) + $otherBusiness;       // 9 ka 30%
$validBusiness50 = min($topLegBusiness, 15) + $otherBusiness;     // 50 ka 30%
$validBusiness150 = min($topLegBusiness, 45) + $otherBusiness;    // 150 ka 30%
$validBusiness512 = min($topLegBusiness, 153) + $otherBusiness;   // 512 ka 30%

// Depth valid business

// ================= LEVEL 2 VALID =================

$topLegLevel2 = 0;

foreach ($level1Users as $member) {

    $memberLevel2Count = User::where('sponsor_id', $member->id)->count();

    if ($memberLevel2Count > $topLegLevel2) {
        $topLegLevel2 = $memberLevel2Count;
    }
}

// Level 1


// Level 1
$level1Display = $level1Count;

// Level 2 Progress
$level2Display = $level2Count;

// Level 2 Complete Check
$level2Green = false;

if($level1Count >= 3 && $level2Count >= 9){

    $qualifiedLegs = 0;

    foreach($level1Users as $member){

        $memberCount = User::where('sponsor_id', $member->id)->count();

        if($memberCount >= 3){
            $qualifiedLegs++;
        }
    }

    // Top Leg Rule
    $topLeg = max($legs);

    $topLegPercent = $level2Count > 0
        ? ($topLeg / $level2Count) * 100
        : 0;

    if(
        $qualifiedLegs >= 3 &&
        $topLegPercent <= 30
    ){
        $level2Green = true;
    }
}

// Temporary
$level3Display = $level3Count;
$level4Display = $level4Count;
$level5Display = $level5Count;

// Qualification Logic

$level1Valid = ($level1Count >= 3);

$level2Valid = $level2Green;
$level3Valid = false;
$level4Valid = false;
$level5Valid = false;

// Rank Logic

$rankName = 'Pre Sales Executive';
$reward = 'No Reward';

// Rank 1 (3 Directs)
if($selfSales >= 3){
    $rankName = 'Sales Executive';
    $reward = 'Tab + Kit';
}

// Rank 2 (Level 2 Complete)
if($level2Valid){
    $rankName = 'Sr. Sales Executive';
    $reward = 'Vivtron Scooty';
}

// Rank 3 (Level 3 Complete)
if($level3Valid){
    $rankName = 'Sales Manager';
    $reward = 'AC Charger';
}

// Rank 4 (Level 4 Complete)
if($level4Valid){
    $rankName = 'Sr. Sales Manager';
    $reward = 'Car Upto 10 Lakh';
}

// Rank 5 (Level 5 Complete)
if($level5Valid){
    $rankName = 'Team Head';
    $reward = 'Home Worth 50 Lakh';
}

    $recentIncome = \App\Models\Income::where('user_id', $user->id)
                    ->latest()
                    ->take(5)
                    ->get();

    $recentWithdrawals = \App\Models\Withdrawal::where('user_id', $user->id)
                        ->latest()
                        ->take(5)
                        ->get();

   return view('dashboard', compact(
    'directReferrals',
    'totalTeam',
    'referrals',
    'totalPoints',
    'totalIncome',
    'walletBalance',
    'operationalSales',
    'recentIncome',
    'recentWithdrawals',

    'level1Users',

    'level1Count',
    'level2Count',
    'level3Count',
    'level4Count',
    'level5Count',
    'level6Count',
    'level7Count',
    'level8Count',
    'level9Count',
    'level10Count',

    'networkTree',

    'selfSales',
    'teamSales',
    'totalSales',

    'totalBusiness',

    'topLegBusiness',
    'otherBusiness',

    'validBusiness9',
    'validBusiness50',
    'validBusiness150',
    'validBusiness512',

     'level1Display',
'level2Display',
'level3Display',
'level4Display',
'level5Display',

'level1Valid',
'level2Valid',
'level3Valid',
'level4Valid',
'level5Valid',

    'rankName',
    'reward'
));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/kyc', [KycController::class, 'create'])->name('kyc.create');
    Route::post('/kyc', [KycController::class, 'store'])->name('kyc.store');

    Route::get('/bank', [BankDetailController::class, 'create'])->name('bank.create');
    Route::post('/bank', [BankDetailController::class, 'store'])->name('bank.store');

    Route::get('/income', [IncomeController::class, 'index'])->name('income.index');

    Route::get('/withdrawals', [WithdrawalController::class, 'index'])->name('withdrawals.index');
    Route::post('/withdrawals', [WithdrawalController::class, 'store'])->name('withdrawals.store');

 Route::get('/my-team', function () {

    $directTeam = User::where('sponsor_id', auth()->id())->get();

    return view('team.index', compact('directTeam'));

})->name('team.index');

    Route::get('/team-tree', [TeamController::class, 'index'])
    ->name('team.tree');

    Route::get('/stations', [ChargingStationController::class, 'index'])
        ->name('stations.index');
    Route::get('/stations/markers', [ChargingStationController::class, 'markers'])
        ->name('stations.markers');
    Route::get('/stations/reverse-geocode', [ChargingStationController::class, 'reverseGeocode'])
        ->name('stations.reverse-geocode');
    Route::post('/stations', [ChargingStationController::class, 'store'])
        ->name('stations.store');
    
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::post('/admin/users/{id}/toggle-status', [AdminController::class, 'toggleUserStatus'])
        ->name('admin.users.toggle-status');

    Route::get('/admin/stations', [AdminChargingStationController::class, 'index'])
        ->name('admin.stations');
    Route::post('/admin/mappls-token', [AdminChargingStationController::class, 'updateMapplsToken'])
        ->name('admin.mappls.token');
    Route::post('/admin/stations/{station}/toggle', [AdminChargingStationController::class, 'toggle'])
        ->name('admin.stations.toggle');

    Route::get('/admin/kycs', [AdminKycController::class, 'index'])
        ->name('admin.kycs');

    Route::get('/admin/kyc/{id}/approve', [AdminKycController::class, 'approve'])
        ->name('admin.kyc.approve');

    Route::get('/admin/kyc/{id}/reject', [AdminKycController::class, 'reject'])
        ->name('admin.kyc.reject');

    Route::get('/admin/withdrawals', [AdminWithdrawalController::class, 'index'])
        ->name('admin.withdrawals');

    Route::get('/admin/withdrawal/{id}/approve', [AdminWithdrawalController::class, 'approve'])
        ->name('admin.withdrawal.approve');

    Route::get('/admin/withdrawal/{id}/reject', [AdminWithdrawalController::class, 'reject'])
        ->name('admin.withdrawal.reject');

    Route::get('/admin/sales', [SaleController::class, 'index'])
        ->name('sales.index');

            Route::get('/admin/sales', [SaleController::class, 'index'])
        ->name('admin.sales');

    Route::post('/admin/sales', [SaleController::class, 'store'])
        ->name('sales.store');

    Route::get('/admin/sales/{id}/approve', [SaleController::class, 'approve'])
        ->name('sales.approve');

    Route::get('/admin/sales/{id}/operational', [SaleController::class, 'operational'])
        ->name('sales.operational');

    Route::get('/admin/sales/{id}/reject', [SaleController::class, 'reject'])
        ->name('sales.reject');

    Route::get('/admin/banks', [AdminBankController::class, 'index'])
        ->name('admin.banks');

    Route::post('/admin/banks/{id}/approve', [AdminBankController::class, 'approve'])
        ->name('admin.banks.approve');

    Route::post('/admin/banks/{id}/reject', [AdminBankController::class, 'reject'])
        ->name('admin.banks.reject');

    Route::get('/admin/rewards', [AdminRewardController::class, 'index'])
        ->name('admin.rewards');

    Route::get('/admin/reward/{id}/approve', [AdminRewardController::class, 'approve'])
        ->name('admin.reward.approve');

    Route::get('/admin/reward/{id}/paid', [AdminRewardController::class, 'paid'])
        ->name('admin.reward.paid');

        Route::get('/admin/ranks', [RankSettingController::class, 'index'])
    ->name('admin.ranks');

    Route::get('/admin/reward-settings', [RewardSettingController::class, 'index'])
    ->name('admin.reward.settings');

Route::post('/admin/reward-settings/store', [RewardSettingController::class, 'store'])
    ->name('admin.reward.settings.store');

Route::get('/admin/reward-settings/delete/{id}', [RewardSettingController::class, 'delete'])
    ->name('admin.reward.settings.delete');

    Route::get('/admin/reward-settings/edit/{id}', [RewardSettingController::class, 'edit'])
    ->name('admin.reward.settings.edit');

Route::post('/admin/reward-settings/update/{id}', [RewardSettingController::class, 'update'])
    ->name('admin.reward.settings.update');

    Route::get('/admin/level-settings', [LevelSettingController::class, 'index'])
    ->name('admin.level.settings');

Route::post('/admin/level-settings', [LevelSettingController::class, 'store'])
    ->name('admin.level.settings.store');

Route::get('/admin/level-settings/delete/{id}', [LevelSettingController::class, 'delete'])
    ->name('admin.level.settings.delete');

    Route::get('/admin/income', [AdminIncomeController::class, 'index'])
    ->name('admin.income');

Route::post('/admin/income/store', [AdminIncomeController::class, 'store'])
    ->name('admin.income.store');

    Route::get('/admin/royalty-settings', [RoyaltyController::class, 'index'])
    ->name('admin.royalty.settings');

Route::post('/admin/royalty-settings/store', [RoyaltyController::class, 'store'])
    ->name('admin.royalty.settings.store');

Route::get('/admin/royalty-settings/delete/{id}', [RoyaltyController::class, 'delete'])
    ->name('admin.royalty.settings.delete');

    Route::get('/admin/income/export', [IncomeController::class, 'export'])
    ->name('admin.income.export');

    // Route::get('/my-team', [TeamController::class, 'index'])
    // ->name('my.team');

    Route::get('/admin/users/export', [AdminController::class, 'exportUsers'])
    ->name('admin.users.export');

    Route::get('/admin/sales/export', [AdminController::class, 'exportSales'])
    ->name('admin.sales.export');

    Route::get('/admin/withdrawals/export', [AdminController::class, 'exportWithdrawals'])
    ->name('admin.withdrawals.export');

    Route::get('/admin/employees', [EmployeeManagementController::class, 'index'])->name('admin.employees');

Route::get('/admin/employees/create', [EmployeeManagementController::class, 'create'])->name('admin.employees.create');

Route::post('/admin/employees/store', [EmployeeManagementController::class, 'store'])->name('admin.employees.store');

Route::post('/profile/upload-image', [ProfileController::class, 'uploadImage'])
    ->name('profile.upload.image');

});


/*
|--------------------------------------------------------------------------
| Employee Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'employee'])->group(function () {

    Route::get('/employee', [EmployeeController::class, 'dashboard'])
        ->name('employee.dashboard');

         Route::get('/admin/sales', [SaleController::class, 'index'])
        ->name('admin.sales');

        Route::get('/admin/withdrawals', [AdminWithdrawalController::class, 'index'])
        ->name('admin.withdrawals');

 Route::get('/admin/banks', [AdminBankController::class, 'index'])
        ->name('admin.banks');

    Route::get('/admin/reward-settings', [RewardSettingController::class, 'index'])
        ->name('admin.reward.settings');


});

require __DIR__.'/auth.php';
