<x-app-layout>
   <style>
        .admin-home {
            background: linear-gradient(180deg, rgba(232, 242, 251, .7), rgba(244, 248, 252, 0) 30rem);
        }

        .admin-home .admin-stat-grid {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .admin-home .bg-white {
            border-color: #dce8f3;
        }

        .admin-home .rounded-3xl,
        .admin-home .rounded-2xl {
            border-radius: .75rem;
            box-shadow: 0 14px 34px rgba(13, 62, 108, .08);
        }

        .admin-home .rounded-3xl:hover,
        .admin-home .rounded-2xl:hover {
            box-shadow: 0 20px 42px rgba(13, 62, 108, .13);
            transform: translateY(-2px);
        }

        .admin-home table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .admin-home table th {
            color: #41627d;
            font-size: .68rem;
            font-weight: 800;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .admin-home table td,
        .admin-home table th {
            border-color: #e5eef5;
        }

        .admin-home .members-table-wrap {
            max-height: 30rem;
            overflow: auto;
            scrollbar-width: thin;
            scrollbar-color: #9eb8d7 transparent;
        }

        .admin-home .members-table-wrap thead th {
            position: sticky;
            top: 0;
            z-index: 2;
            background: #edf7fb;
        }

        .admin-home .member-pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .75rem;
            border-top: 1px solid #e5eef5;
            padding: .8rem 1.25rem;
            background: #fbfdff;
        }

        .admin-home .member-pagination button {
            min-width: 5rem;
            border: 1px solid #cbddeb;
            border-radius: .55rem;
            padding: .45rem .7rem;
            color: #174873;
            background: #fff;
            font-size: .75rem;
            font-weight: 800;
        }

        .admin-home .member-pagination button:disabled {
            cursor: not-allowed;
            opacity: .45;
        }

        .admin-home .admin-table-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .admin-home .member-search,
        .admin-home .member-filter {
            min-height: 2.55rem;
            border: 1px solid #cdddeb;
            border-radius: .65rem;
            background: #f9fcff;
            color: #193e61;
            font-size: .78rem;
            outline: none;
        }

        .admin-home .member-search {
            width: min(20rem, 100%);
            padding: .65rem .85rem .65rem 2.25rem;
        }

        .admin-home .member-filter {
            padding: .65rem 2rem .65rem .75rem;
        }

        .admin-home .member-search:focus,
        .admin-home .member-filter:focus {
            border-color: #3b8bd9;
            box-shadow: 0 0 0 4px rgba(59, 139, 217, .12);
        }

        .admin-home .search-wrap {
            position: relative;
        }

        .admin-home .search-wrap span {
            position: absolute;
            left: .8rem;
            top: .55rem;
            color: #7494af;
            font-size: .95rem;
        }

        @media (max-width: 1100px) {
            .admin-home .admin-stat-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .admin-home .admin-stat-grid {
                grid-template-columns: 1fr;
            }

            .admin-home .member-search {
                width: 100%;
            }
        }
   </style>
   <x-slot name="header">
    <div class="admin-page-heading bg-gradient-to-r from-[#0B2E6B] via-[#0E5C97] to-[#00A878] rounded-2xl shadow-lg px-8 py-6 flex items-center justify-between">

        <div>
            <h2 class="text-3xl font-bold text-white">
                Admin Dashboard
            </h2>

            <p class="text-blue-100 mt-1 text-sm">
                Welcome to Vivtron EVCS Administration Panel
            </p>
        </div>

        <div class="hidden md:flex items-center gap-3">

            <div class="bg-white/20 backdrop-blur-md rounded-xl px-4 py-3 text-center">

                <p class="text-xs text-white">
                    Status
                </p>

                <p class="text-green-300 font-bold">
                    Online
                </p>

            </div>

        </div>

    </div>
</x-slot>

    <div class="admin-home py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


       
         <!-- Statistics Cards -->
<div class="admin-stat-grid grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 px-6 py-4 mb-6">

    <!-- Total Members -->
    <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
        <div class="h-2 bg-gradient-to-r from-[#0B2E6B] via-[#0E5C97] to-[#00A878]"></div>

        <div class="p-6 flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm">Total Members</p>
                <h2 class="text-4xl font-bold text-[#0B2E6B] mt-2">{{ $totalMembers }}</h2>
            </div>

            <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center text-3xl">
                👥
            </div>
        </div>

        <div class="border-t px-6 py-4">
            <p class="text-[#00A878] font-semibold">Registered Members</p>
        </div>
    </div>

    <!-- Pending KYC -->
    <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
        <div class="h-2 bg-gradient-to-r from-yellow-400 to-orange-500"></div>

        <div class="p-6 flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm">Pending KYC</p>
                <h2 class="text-4xl font-bold text-yellow-500 mt-2">{{ $pendingKyc }}</h2>
            </div>

            <div class="w-16 h-16 rounded-full bg-yellow-100 flex items-center justify-center text-3xl">
                📝
            </div>
        </div>

        <div class="border-t px-6 py-4">
            <p class="text-yellow-500 font-semibold">Waiting Approval</p>
        </div>
    </div>

    <!-- Approved KYC -->
    <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
        <div class="h-2 bg-gradient-to-r from-green-500 to-[#00A878]"></div>

        <div class="p-6 flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm">Approved KYC</p>
                <h2 class="text-4xl font-bold text-green-600 mt-2">{{ $approvedKyc }}</h2>
            </div>

            <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center text-3xl">
                ✅
            </div>
        </div>

        <div class="border-t px-6 py-4">
            <p class="text-green-600 font-semibold">Verified Members</p>
        </div>
    </div>

    <!-- Total Income -->
    <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
        <div class="h-2 bg-gradient-to-r from-[#0B2E6B] to-[#00A878]"></div>

        <div class="p-6 flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm">Total Income</p>
                <h2 class="text-4xl font-bold text-[#0B2E6B] mt-2">₹{{ number_format($totalIncome,2) }}</h2>
            </div>

            <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center text-3xl">
                💰
            </div>
        </div>

        <div class="border-t px-6 py-4">
            <p class="text-[#00A878] font-semibold">Total Earnings</p>
        </div>
    </div>

    <!-- Total Withdrawals -->
    <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
        <div class="h-2 bg-gradient-to-r from-red-500 to-red-700"></div>

        <div class="p-6 flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm">Total Withdrawals</p>
                <h2 class="text-4xl font-bold text-red-600 mt-2">₹{{ number_format($totalWithdrawals,2) }}</h2>
            </div>

            <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center text-3xl">
                💸
            </div>
        </div>

        <div class="border-t px-6 py-4">
            <p class="text-red-600 font-semibold">Completed Withdrawals</p>
        </div>
    </div>

    <!-- Pending Withdrawals -->
    <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
        <div class="h-2 bg-gradient-to-r from-orange-400 to-orange-600"></div>

        <div class="p-6 flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm">Pending Withdrawals</p>
                <h2 class="text-4xl font-bold text-orange-500 mt-2">{{ $pendingWithdrawals }}</h2>
            </div>

            <div class="w-16 h-16 rounded-full bg-orange-100 flex items-center justify-center text-3xl">
                ⏳
            </div>
        </div>

        <div class="border-t px-6 py-4">
            <p class="text-orange-500 font-semibold">Awaiting Payment</p>
        </div>
    </div>

    <!-- Total Sales -->
    <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
        <div class="h-2 bg-gradient-to-r from-cyan-500 to-blue-500"></div>

        <div class="p-6 flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm">Total Sales Amount</p>
                <h2 class="text-4xl font-bold text-cyan-600 mt-2">₹{{ number_format($totalSales,2) }}</h2>
            </div>

            <div class="w-16 h-16 rounded-full bg-cyan-100 flex items-center justify-center text-3xl">
                📈
            </div>
        </div>

        <div class="border-t px-6 py-4">
            <p class="text-cyan-600 font-semibold">Overall Sales</p>
        </div>
    </div>

    <!-- Operational Sales -->
    <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
        <div class="h-2 bg-gradient-to-r from-indigo-500 to-indigo-700"></div>

        <div class="p-6 flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm">Operational Sales</p>
                <h2 class="text-4xl font-bold text-indigo-600 mt-2">{{ $operationalSales }}</h2>
            </div>

            <div class="w-16 h-16 rounded-full bg-indigo-100 flex items-center justify-center text-3xl">
                ⚡
            </div>
        </div>

        <div class="border-t px-6 py-4">
            <p class="text-indigo-600 font-semibold">Operational Orders</p>
        </div>
    </div>

    <!-- Pending Sales -->
    <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
        <div class="h-2 bg-gradient-to-r from-pink-500 to-pink-700"></div>

        <div class="p-6 flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm">Pending Sales</p>
                <h2 class="text-4xl font-bold text-pink-600 mt-2">{{ $pendingSales }}</h2>
            </div>

            <div class="w-16 h-16 rounded-full bg-pink-100 flex items-center justify-center text-3xl">
                📦
            </div>
        </div>

        <div class="border-t px-6 py-4">
            <p class="text-pink-600 font-semibold">Pending Orders</p>
        </div>
    </div>

    <!-- Total Rewards -->
    <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
        <div class="h-2 bg-gradient-to-r from-teal-500 to-green-500"></div>

        <div class="p-6 flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm">Total Rewards</p>
                <h2 class="text-4xl font-bold text-teal-600 mt-2">{{ $totalRewards }}</h2>
            </div>

            <div class="w-16 h-16 rounded-full bg-teal-100 flex items-center justify-center text-3xl">
                🏆
            </div>
        </div>

        <div class="border-t px-6 py-4">
            <p class="text-teal-600 font-semibold">Earned Rewards</p>
        </div>
    </div>

    <!-- Paid Rewards -->
    <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
        <div class="h-2 bg-gradient-to-r from-lime-500 to-green-600"></div>

        <div class="p-6 flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm">Paid Rewards</p>
                <h2 class="text-4xl font-bold text-lime-600 mt-2">{{ $paidRewards }}</h2>
            </div>

            <div class="w-16 h-16 rounded-full bg-lime-100 flex items-center justify-center text-3xl">
                🎁
            </div>
        </div>

        <div class="border-t px-6 py-4">
            <p class="text-lime-600 font-semibold">Successfully Paid</p>
        </div>
    </div>

</div>


<!-- Latest Sales -->
<div class="px-6 mb-8">

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-[#0B2E6B] via-[#0E5C97] to-[#00A878] px-6 py-4">
            <h2 class="text-2xl font-bold text-white">
                Latest Sales
            </h2>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-4 text-left font-bold">ID</th>
                        <th class="px-6 py-4 text-left font-bold">User ID</th>
                        <th class="px-6 py-4 text-left font-bold">Amount</th>
                        <th class="px-6 py-4 text-left font-bold">Status</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($latestSales as $sale)

                    <tr class="border-b hover:bg-blue-50 duration-300">

                        <td class="px-6 py-4">{{ $sale->id }}</td>

                        <td class="px-6 py-4">{{ $sale->user_id }}</td>

                        <td class="px-6 py-4 font-semibold text-green-600">
                            ₹{{ $sale->sale_value }}
                        </td>

                        <td class="px-6 py-4">

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">

                                {{ $sale->status }}

                            </span>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- Latest Withdrawals -->
<div class="px-6 mb-8">

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

        <!-- Header -->
        <div class="bg-gradient-to-r from-[#0B2E6B] via-[#0E5C97] to-[#00A878] px-6 py-4">
            <h2 class="text-2xl font-bold text-white">
                Latest Withdrawals
            </h2>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr class="text-gray-700">

                        <th class="px-6 py-4 text-left font-semibold">
                            ID
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            User ID
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Amount
                        </th>

                        <th class="px-6 py-4 text-left font-semibold">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($latestWithdrawals as $withdrawal)

                    <tr class="border-b hover:bg-blue-50 transition duration-300">

                        <td class="px-6 py-4 font-medium text-gray-700">
                            {{ $withdrawal->id }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $withdrawal->user_id }}
                        </td>

                        <td class="px-6 py-4 font-bold text-green-600">
                            ₹{{ number_format($withdrawal->amount,2) }}
                        </td>

                        <td class="px-6 py-4">

                            @if(strtolower($withdrawal->status) == 'approved')

                                <span class="px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                                    Approved
                                </span>

                            @elseif(strtolower($withdrawal->status) == 'pending')

                                <span class="px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-700">
                                    Pending
                                </span>

                            @elseif(strtolower($withdrawal->status) == 'rejected')

                                <span class="px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                                    Rejected
                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full text-sm font-semibold bg-gray-100 text-gray-700">
                                    {{ ucfirst($withdrawal->status) }}
                                </span>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="4" class="text-center py-10 text-gray-500">

                            No withdrawal records found.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


            <!-- Members Table -->
           <!-- All Members -->
<div class="px-6 mb-8">

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

        <!-- Header -->
        <div class="bg-gradient-to-r from-[#0B2E6B] via-[#0E5C97] to-[#00A878] px-6 py-4">
            <div class="admin-table-toolbar">
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[.16em] text-blue-100">Member directory</p>
                    <h2 class="mt-1 text-2xl font-bold text-white">All Members</h2>
                </div>
                <div class="flex w-full flex-col gap-2 sm:w-auto sm:flex-row">
                    <div class="search-wrap">
                        <span>⌕</span>
                        <input id="memberSearch" type="search" class="member-search" placeholder="Search name, email or code" aria-label="Search members">
                    </div>
                    <select id="memberStatusFilter" class="member-filter" aria-label="Filter members by status">
                        <option value="all">All statuses</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div id="membersTableWrap" class="members-table-wrap overflow-x-auto">

            <table class="w-full">

                <thead class="bg-gray-100">

                    <tr class="text-gray-700">

                        <th class="px-6 py-4 text-left font-semibold">ID</th>
                        <th class="px-6 py-4 text-left font-semibold">Name</th>
                        <th class="px-6 py-4 text-left font-semibold">Email</th>
                        <th class="px-6 py-4 text-left font-semibold">Referral Code</th>
                        <th class="px-6 py-4 text-left font-semibold">Wallet</th>
                        <th class="px-6 py-4 text-left font-semibold">Status</th>
                        <th class="px-6 py-4 text-left font-semibold">Rank</th>

                    </tr>

                </thead>

                <tbody id="membersTableBody">

                    @forelse($users as $user)

                    <tr class="border-b hover:bg-blue-50 transition duration-300">

                        <td class="px-6 py-4 font-medium text-gray-700">
                            {{ $user->id }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ $user->name }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $user->referral_code }}
                            </span>
                        </td>

                        <td class="px-6 py-4 font-bold text-green-600">
                            ₹{{ number_format($user->wallet_balance,2) }}
                        </td>

                        <td class="px-6 py-4">

                            @if(strtolower($user->status) == 'active')

                                <form method="POST" action="{{ route('admin.users.toggle-status', $user->id) }}" onsubmit="return toggleMemberStatus(event, this)">
                                    @csrf
                                    <button type="submit" data-status-button data-status="active" title="Tap to make inactive" class="inline-flex items-center gap-2 rounded-full bg-green-100 px-3 py-1.5 text-sm font-semibold text-green-700 transition hover:bg-red-100 hover:text-red-700">
                                        <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                        Active
                                    </button>
                                </form>

                            @elseif(strtolower($user->status) == 'inactive')

                                <form method="POST" action="{{ route('admin.users.toggle-status', $user->id) }}" onsubmit="return toggleMemberStatus(event, this)">
                                    @csrf
                                    <button type="submit" data-status-button data-status="inactive" title="Tap to make active" class="inline-flex items-center gap-2 rounded-full bg-red-100 px-3 py-1.5 text-sm font-semibold text-red-700 transition hover:bg-green-100 hover:text-green-700">
                                        <span class="h-2 w-2 rounded-full bg-red-500"></span>
                                        Inactive
                                    </button>
                                </form>

                            @elseif(strtolower($user->status) == 'pending')

                                <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">
                                    Pending
                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-sm font-semibold">
                                    {{ ucfirst($user->status) }}
                                </span>

                            @endif

                        </td>

                        <td class="px-6 py-4">

                            <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $user->rank }}
                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7" class="text-center py-10 text-gray-500 text-lg">
                            No Members Found
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="member-pagination">
            <p id="memberPageInfo" class="text-xs font-semibold text-slate-500">Showing members</p>
            <div class="flex items-center gap-2">
                <button type="button" id="memberPrev" disabled>Previous</button>
                <button type="button" id="memberNext" disabled>Next</button>
            </div>
        </div>

    </div>

</div>

        </div>
    </div>

    <script>
        async function toggleMemberStatus(event, form) {
            event.preventDefault();

            const button = form.querySelector('[data-status-button]');
            if (!button || button.disabled) return false;

            const originalLabel = button.textContent.trim();
            button.disabled = true;
            button.classList.add('opacity-60', 'cursor-wait');

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                    },
                    body: new FormData(form),
                });

                const data = await response.json();
                if (!response.ok || !data.success) throw new Error(data.message || 'Status update failed.');

                const isActive = data.status === 'active';
                button.dataset.status = data.status;
                button.title = isActive ? 'Tap to make inactive' : 'Tap to make active';
                button.className = isActive
                    ? 'inline-flex items-center gap-2 rounded-full bg-green-100 px-3 py-1.5 text-sm font-semibold text-green-700 transition hover:bg-red-100 hover:text-red-700'
                    : 'inline-flex items-center gap-2 rounded-full bg-red-100 px-3 py-1.5 text-sm font-semibold text-red-700 transition hover:bg-green-100 hover:text-green-700';
                button.innerHTML = `<span class="h-2 w-2 rounded-full ${isActive ? 'bg-green-500' : 'bg-red-500'}"></span>${isActive ? 'Active' : 'Inactive'}`;
                button.disabled = false;
            } catch (error) {
                button.disabled = false;
                button.textContent = originalLabel;
                form.submit();
            }

            return false;
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const search = document.getElementById('memberSearch');
            const filter = document.getElementById('memberStatusFilter');
            const rows = Array.from(document.querySelectorAll('#membersTableBody tr')).filter(function (row) {
                return !row.querySelector('td[colspan]');
            });
            const previous = document.getElementById('memberPrev');
            const next = document.getElementById('memberNext');
            const pageInfo = document.getElementById('memberPageInfo');
            const pageSize = 8;
            let currentPage = 1;

            if (!search || !filter || !rows.length || !previous || !next || !pageInfo) return;

            const applyMemberFilters = function () {
                const query = search.value.trim().toLowerCase();
                const status = filter.value;
                const matchingRows = rows.filter(function (row) {
                    const text = row.textContent.toLowerCase();
                    const matchesText = !query || text.includes(query);
                    const matchesStatus = status === 'all' || new RegExp('\\b' + status + '\\b').test(text);
                    return matchesText && matchesStatus;
                });
                const totalPages = Math.max(1, Math.ceil(matchingRows.length / pageSize));
                currentPage = Math.min(currentPage, totalPages);
                const start = (currentPage - 1) * pageSize;

                rows.forEach(function (row) {
                    row.hidden = true;
                });
                matchingRows.slice(start, start + pageSize).forEach(function (row) {
                    row.hidden = false;
                });

                previous.disabled = currentPage <= 1;
                next.disabled = currentPage >= totalPages;
                pageInfo.textContent = matchingRows.length
                    ? `Showing ${start + 1}-${Math.min(start + pageSize, matchingRows.length)} of ${matchingRows.length} members`
                    : 'No matching members';
            };

            search.addEventListener('input', function () {
                currentPage = 1;
                applyMemberFilters();
            });
            filter.addEventListener('change', function () {
                currentPage = 1;
                applyMemberFilters();
            });
            previous.addEventListener('click', function () {
                currentPage -= 1;
                applyMemberFilters();
            });
            next.addEventListener('click', function () {
                currentPage += 1;
                applyMemberFilters();
            });

            applyMemberFilters();
        });
    </script>
</x-app-layout>
