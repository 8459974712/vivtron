<x-app-layout>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Employee Dashboard
    </h2>
</x-slot>

<div class="py-8">
    <div class="max-w-7xl mx-auto px-4">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            @if($permission && $permission->users_access)
            <div class="bg-blue-100 p-5 rounded shadow">
                <h3 class="font-bold">Total Users</h3>
                <p class="text-3xl">{{ $totalUsers }}</p>
            </div>
            @endif

            @if($permission && $permission->kyc_access)
            <div class="bg-yellow-100 p-5 rounded shadow">
                <h3 class="font-bold">Pending KYC</h3>
                <p class="text-3xl">{{ $pendingKyc }}</p>
            </div>
            @endif

            @if($permission && $permission->sales_access)
            <div class="bg-green-100 p-5 rounded shadow">
                <h3 class="font-bold">Pending Sales</h3>
                <p class="text-3xl">{{ $pendingSales }}</p>
            </div>
            @endif

            @if($permission && $permission->withdrawal_access)
            <div class="bg-red-100 p-5 rounded shadow">
                <h3 class="font-bold">Pending Withdrawals</h3>
                <p class="text-3xl">{{ $pendingWithdrawals }}</p>
            </div>
            @endif

        </div>

    </div>
</div>

</x-app-layout>