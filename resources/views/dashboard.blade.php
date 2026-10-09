
<x-app-layout>

    <style>
        .app-content > .py-12 {
            padding: 2rem clamp(1rem, 3vw, 2.5rem) 3.5rem !important;
        }

        .app-content .container,
        .app-content .max-w-7xl {
            max-width: 1440px;
        }

        .app-content .rounded-2xl,
        .app-content .rounded-3xl,
        .app-content .rounded-xl {
            border-radius: .85rem;
            border-color: #dce8f5;
            box-shadow: 0 12px 32px rgba(13, 62, 108, .08);
            transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
        }

        .app-content .rounded-2xl:hover,
        .app-content .rounded-3xl:hover,
        .app-content .rounded-xl:hover {
            transform: translateY(-3px);
            border-color: #c7d9ec;
            box-shadow: 0 18px 38px rgba(13, 62, 108, .12);
        }

        .app-content button,
        .app-content a[class*="bg-"] {
            border-radius: .6rem;
            font-weight: 600;
            letter-spacing: .01em;
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
        }

        .app-content button:hover,
        .app-content a[class*="bg-"]:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(12, 79, 154, .16);
        }

        .app-content input[readonly] {
            color: #173f73;
            background: #f7fbff;
            border-color: #cddded;
            outline: none;
        }

        .app-content table th {
            font-size: .72rem;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .app-content table td,
        .app-content table th {
            white-space: nowrap;
        }

        .dashboard-page {
            background: linear-gradient(180deg, rgba(232, 242, 251, .58) 0%, rgba(244, 248, 252, 0) 28rem);
        }

        .dashboard-command-bar {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 1.5rem;
            width: min(97%, 1440px);
            margin: 0 auto 1.5rem;
        }

        .dashboard-command-bar .eyebrow {
            color: #168767;
            font-size: .68rem;
            font-weight: 800;
            letter-spacing: .18em;
            text-transform: uppercase;
        }

        .dashboard-command-bar h1 {
            margin-top: .3rem;
            color: #082f63;
            font-size: clamp(1.65rem, 3vw, 2.35rem);
            font-weight: 800;
            letter-spacing: 0;
        }

        .dashboard-command-bar .subline {
            margin-top: .3rem;
            color: #6b8197;
            font-size: .84rem;
        }

        .dashboard-actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: .6rem;
        }

        .dashboard-actions a {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            border: 1px solid #d4e2ef;
            border-radius: .7rem;
            padding: .65rem .85rem;
            background: rgba(255, 255, 255, .82);
            color: #164775;
            font-size: .75rem;
            font-weight: 800;
            box-shadow: 0 6px 18px rgba(13, 62, 108, .06);
            transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease;
        }

        .dashboard-actions a:hover {
            border-color: #8bbbe5;
            box-shadow: 0 10px 22px rgba(13, 62, 108, .12);
            transform: translateY(-2px);
        }

        .dashboard-actions a.primary {
            border-color: #0b3b73;
            background: #0b3b73;
            color: #fff;
        }

        .dashboard-page > .flex:first-of-type > div > div:first-child {
            background:
                linear-gradient(135deg, rgba(255, 255, 255, .98), rgba(242, 249, 255, .96)),
                #fff;
            border-color: #cfe0ef;
            box-shadow: 0 20px 46px rgba(9, 60, 111, .12);
        }

        .dashboard-page > .flex:first-of-type > div > div:first-child::after {
            content: "";
            position: absolute;
            right: 1.5rem;
            bottom: -3rem;
            width: 11rem;
            height: 11rem;
            border: 1px solid rgba(19, 168, 107, .16);
            border-radius: 50%;
            box-shadow: 0 0 0 1.2rem rgba(19, 168, 107, .05), 0 0 0 2.4rem rgba(19, 168, 107, .035);
            pointer-events: none;
        }

        .dashboard-page > .flex:first-of-type > div > div:nth-child(2) {
            border-color: #cfe0ef;
            box-shadow: 0 20px 46px rgba(9, 60, 111, .12);
        }

        .dashboard-page .rounded-3xl {
            min-height: 10.6rem;
            border-radius: .75rem;
            border-color: #d7e5f0;
            background: rgba(255, 255, 255, .96);
            box-shadow: 0 14px 32px rgba(13, 62, 108, .08);
        }

        .dashboard-page .rounded-2xl,
        .dashboard-page .rounded-xl {
            border-radius: .75rem;
        }

        .dashboard-page .rounded-3xl:hover {
            box-shadow: 0 20px 42px rgba(13, 62, 108, .14);
        }

        .dashboard-page .rounded-3xl .rounded-full {
            width: 3.35rem;
            height: 3.35rem;
            border: 5px solid #fff;
            box-shadow: 0 8px 18px rgba(13, 62, 108, .1);
        }

        .dashboard-page .rounded-xl {
            border-color: #d7e5f0;
            box-shadow: 0 14px 32px rgba(13, 62, 108, .08);
        }

        .dashboard-page .rounded-xl > div:first-child {
            letter-spacing: .01em;
        }

        .dashboard-page table tbody tr:last-child td {
            border-bottom: 0;
        }

        .dashboard-page table td:first-child {
            font-weight: 650;
            color: #214666;
        }

        @media (max-width: 1023px) {
            .dashboard-command-bar {
                align-items: flex-start;
                flex-direction: column;
                gap: 1rem;
            }

            .dashboard-actions {
                justify-content: flex-start;
            }

            .app-content > .py-12 {
                padding: 1.25rem .9rem 2.5rem !important;
            }

            .app-content .grid {
                width: 100% !important;
            }

            .app-content .text-4xl {
                font-size: 2rem;
            }
        }
    </style>
    

    <div class="dashboard-page py-12">

        <div class="dashboard-command-bar">
            <div>
                <p class="eyebrow">Member workspace</p>
                <h1>Overview</h1>
                <p class="subline">Your network, earnings and account activity at a glance.</p>
            </div>
            <div class="dashboard-actions">
                <a href="{{ route('profile.edit') }}"><span>👤</span> Profile</a>
                <a href="{{ route('stations.index') }}"><span>⚡</span> Stations</a>
                <a href="{{ route('purchase.create') }}" class="primary"><span>＋</span> Buy Product</a>
            </div>
        </div>
       
         <div class="flex justify-center mb-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 w-full lg:w-[97%]">
    <!-- Welcome Card -->
    <div class="relative bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">

        <!-- Left Border -->
        <div class="absolute left-0 top-0 h-full w-2 bg-gradient-to-b from-[#0B3B73] to-[#3DBE4A]"></div>

        <div class="p-8 pl-10 flex justify-between items-center">

    <div>

        <p class="text-gray-500 uppercase text-sm tracking-wider">
            Dashboard
        </p>

        <h2 class="text-4xl font-bold text-[#0B3B73] mt-2">
            Welcome,
            <span class="text-[#3DBE4A]">
                {{ Auth::user()->name }}
            </span>
        </h2>

        <p class="text-gray-500 mt-3">
            Welcome back! Have a productive day.
        </p>

        <div class="flex gap-6 mt-8">

            <div>
                <p class="text-gray-400 text-sm">Wallet</p>
                <h4 class="font-bold text-xl text-[#0B3B73]">
                    ₹{{ number_format($walletBalance, 2) }}
                </h4>
            </div>

            <div>
                <p class="text-gray-400 text-sm">Rank</p>
                <h4 class="font-bold text-xl text-[#3DBE4A]">
                    {{ $rankName }}
                </h4>
            </div>

        </div>

    </div>

    <img src="https://vivtronevcs.com/wp-content/uploads/2026/05/file_00000000d93c71fa8543361289614009-e1780049716431.png"
         class="h-24 opacity-20"
         alt="Logo">

</div>

    </div>



    <!-- Referral Card -->

    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">

        <div class="border-b px-6 py-5 flex items-center justify-between">

            <h3 class="text-xl font-bold text-[#0B3B73]">
                Referral Details
            </h3>

            <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                Active
            </span>

        </div>

        <div class="p-6">

            <div class="flex justify-between items-center mb-5">

                <div>
                    <p class="text-gray-400 text-sm">
                        Referral Code
                    </p>

                    <h2 class="text-3xl font-bold text-[#0B3B73]">
                        {{ Auth::user()->referral_code }}
                    </h2>
                </div>

                <button
                    onclick="copyCode()"
                    class="bg-[#0B3B73] text-white px-4 py-2 rounded-lg hover:bg-[#0A2E59] transition">

                    Copy Code

                </button>

            </div>

            <p class="text-gray-400 text-sm mb-2">
                Referral Link
            </p>

            <div class="flex">

                <input
                    id="referralLink"
                    readonly
                    class="flex-1 border border-gray-300 rounded-l-lg px-3 py-3 bg-gray-50"
                    value="{{ url('/register?ref=' . Auth::user()->referral_code) }}"
                >

                <button
                    onclick="copyReferralLink()"
                    class="bg-[#3DBE4A] px-5 text-white rounded-r-lg">

                    Copy

                </button>

            </div>

            <div class="grid grid-cols-2 gap-4 mt-6">

                <div class="bg-gray-50 rounded-xl p-4 text-center">

                    <p class="text-gray-400 text-sm">
                        Direct Referrals
                    </p>

                    <h3 class="text-3xl font-bold text-[#3DBE4A]">
                        {{ $directReferrals }}
                    </h3>

                </div>

                <div class="bg-gray-50 rounded-xl p-4 text-center">

                    <p class="text-gray-400 text-sm">
                        Team Size
                    </p>

                    <h3 class="text-3xl font-bold text-[#0B3B73]">
                        {{ $totalTeam }}
                    </h3>

                </div>

            </div>
            

        </div>

    </div>

</div>
</div>


<!-- Dashboard Stats -->
<div class="container">

<!-- Row 1 -->
<div class="flex justify-center mb-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full lg:w-11/12 xl:w-10/12">

        <!-- Total Income -->
        <div class="bg-white rounded-3xl shadow-lg p-6 relative overflow-hidden hover:shadow-2xl transition">
            <div class="absolute top-0 left-0 w-full h-2 bg-[#0A3B73]"></div>

            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Total Income</p>
                    <h2 class="text-4xl font-bold text-[#0A3B73] mt-3">
                        ₹{{ $totalIncome }}
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-full bg-blue-100 flex items-center justify-center text-3xl">
                    💰
                </div>
            </div>

            <div class="mt-8 border-t pt-4 text-[#0A3B73] font-semibold">
                Total Earnings
            </div>
        </div>

        <!-- Wallet -->
        <div class="bg-white rounded-3xl shadow-lg p-6 relative overflow-hidden hover:shadow-2xl transition">
            <div class="absolute top-0 left-0 w-full h-2 bg-[#11A36A]"></div>

            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Wallet Balance</p>
                    <h2 class="text-4xl font-bold text-[#11A36A] mt-3">
                        ₹{{ $walletBalance }}
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center text-3xl">
                    👛
                </div>
            </div>

            <div class="mt-8 border-t pt-4 text-[#11A36A] font-semibold">
                Available Balance
            </div>
        </div>

        <!-- Current Rank -->
        <div class="bg-white rounded-3xl shadow-lg p-6 relative overflow-hidden hover:shadow-2xl transition">
            <div class="absolute top-0 left-0 w-full h-2 bg-[#6CC63F]"></div>

            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-500 text-sm">Current Rank</p>
                    <h2 class="text-3xl font-bold text-[#0A3B73] mt-3">
                        {{ $rankName }}
                    </h2>
                </div>

                <div class="w-14 h-14 rounded-full bg-lime-100 flex items-center justify-center text-3xl">
                    🏆
                </div>
            </div>

            <div class="mt-8 border-t pt-4 text-[#6CC63F] font-semibold">
                Active Rank
            </div>
        </div>

    </div>
</div>

<!-- Row 2 -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full lg:w-11/12 xl:w-10/12 mx-auto mb-8">

    <!-- Operational Sales -->
    <div class="bg-white rounded-3xl shadow-lg p-6 relative overflow-hidden hover:shadow-2xl transition">
        <div class="absolute top-0 left-0 w-full h-2 bg-[#0A3B73]"></div>

        <div class="flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm">Operational Sales</p>
                <h2 class="text-4xl font-bold text-[#0A3B73] mt-3">
                    {{ $operationalSales }}
                </h2>
            </div>

            <div class="w-14 h-14 rounded-full bg-cyan-100 flex items-center justify-center text-3xl">
                📈
            </div>
        </div>

        <div class="mt-8 border-t pt-4 text-cyan-600 font-semibold">
            Monthly Sales
        </div>
    </div>

    <!-- Referral Points -->
    <div class="bg-white rounded-3xl shadow-lg p-6 relative overflow-hidden hover:shadow-2xl transition">
        <div class="absolute top-0 left-0 w-full h-2 bg-[#00A99D]"></div>

        <div class="flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm">Referral Points</p>
                <h2 class="text-4xl font-bold text-[#00A99D] mt-3">
                    {{ $totalPoints }}
                </h2>
            </div>

            <div class="w-14 h-14 rounded-full bg-teal-100 flex items-center justify-center text-3xl">
                🎯
            </div>
        </div>

        <div class="mt-8 border-t pt-4 text-[#00A99D] font-semibold">
            Total Points
        </div>
    </div>

    <!-- Rank & Reward -->
    <div class="bg-white rounded-3xl shadow-lg p-6 relative overflow-hidden hover:shadow-2xl transition">
        <div class="absolute top-0 left-0 w-full h-2 bg-yellow-500"></div>

        <div class="flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm">Reward</p>
                <h2 class="text-xl font-bold text-yellow-600 mt-3">
                    {{ $reward }}
                </h2>
            </div>

            <div class="w-14 h-14 rounded-full bg-yellow-100 flex items-center justify-center text-3xl">
                🎁
            </div>
        </div>

      <div class="mt-4 space-y-2 text-sm">
    
    <div>
        <strong>Self Sales:</strong> {{ $selfSales }}
    </div>

    <div>
        <strong>Team Business:</strong>
        {{ $totalBusiness - $selfSales }}
    </div>

    <div>
        <strong>Total Business:</strong> {{ $totalBusiness }}
    </div>

</div>

        <div class="mt-4 border-t pt-4 text-yellow-600 font-semibold">
            Rank Achievement
        </div>
    </div>

</div>

</div>


<div class="max-w-7xl mx-auto px-6 lg:px-8">
<div class="w-full flex flex-col lg:flex-row gap-6 mt-4 items-start">

    <!-- LEFT SIDE -->
    <div class="w-full lg:w-8/12 space-y-6">

        <!-- My Referrals -->

    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">



        <div class="bg-gradient-to-r from-[#0A2E6F] via-[#124A9E] to-[#1FA97A] px-6 py-4">

            <h4 class="text-xl font-bold text-white">

                My Referrals

            </h4>

        </div>



        <div class="p-6">



            @if($referrals->count())



            <div class="overflow-x-auto">



                <table class="w-full border-collapse">



                    <thead>

                        <tr class="bg-[#EAF7F2] text-[#0A2E6F]">

                            <th class="border border-gray-200 px-4 py-3 text-left">Name</th>

                            <th class="border border-gray-200 px-4 py-3 text-left">Email</th>

                            <th class="border border-gray-200 px-4 py-3 text-left">Referral Code</th>

                        </tr>

                    </thead>



                    <tbody>



                        @foreach($referrals as $referral)



                        <tr class="hover:bg-[#F4FBF8] transition">



                            <td class="border border-gray-200 px-4 py-3">

                                {{ $referral->name }}

                            </td>



                            <td class="border border-gray-200 px-4 py-3">

                                {{ $referral->email }}

                            </td>



                            <td class="border border-gray-200 px-4 py-3 font-semibold text-[#1FA97A]">

                                {{ $referral->referral_code }}

                            </td>



                        </tr>



                        @endforeach



                    </tbody>



                </table>



            </div>



            @else



            <p class="text-gray-500">No referrals found.</p>



            @endif



        </div>



    </div>

    <!-- My Team -->

    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">



        <div class="bg-gradient-to-r from-[#0A2E6F] via-[#124A9E] to-[#1FA97A] px-6 py-4">

            <h4 class="text-xl font-bold text-white">

                My Team

            </h4>

        </div>



        <div class="p-6">



            <div class="overflow-x-auto">



                <table class="w-full border-collapse">



                    <thead>

                        <tr class="bg-[#EAF7F2] text-[#0A2E6F]">

                            <th class="border border-gray-200 px-4 py-3 text-left">Name</th>

                            <th class="border border-gray-200 px-4 py-3 text-left">Referral Code</th>

                            <th class="border border-gray-200 px-4 py-3 text-left">Joining Date</th>

                        </tr>

                    </thead>



                    <tbody>



                        @forelse($referrals as $member)



                        <tr class="hover:bg-[#F4FBF8] transition">



                            <td class="border border-gray-200 px-4 py-3">

                                {{ $member->name }}

                            </td>



                            <td class="border border-gray-200 px-4 py-3 font-semibold text-[#1FA97A]">

                                {{ $member->referral_code }}

                            </td>



                            <td class="border border-gray-200 px-4 py-3">

                                {{ $member->joining_date }}

                            </td>



                        </tr>



                        @empty



                        <tr>

                            <td colspan="3" class="border border-gray-200 px-4 py-4 text-center text-gray-500">

                                No Team Members Found

                            </td>

                        </tr>



                        @endforelse



                    </tbody>



                </table>



            </div>



        </div>



    </div>



    <!-- <div class="bg-white rounded-xl shadow mt-6">

    <div class="bg-gradient-to-r from-blue-900 to-green-500 text-white p-4 rounded-t-xl">
        <h3 class="text-2xl font-bold">Team Tree</h3>
    </div>

    <div class="p-5">

        <ul class="space-y-2">

            @foreach($level1Users as $member)

                <li>

                    <strong>
                        {{ $member->name }}
                    </strong>
@if($member->referrals->count())

    <ul class="ml-6 mt-2">

        @foreach($member->referrals as $child)

            <li>

                ↳ {{ $child->name }}

                @php
                    $grandChildren = \App\Models\User::where(
                        'sponsor_id',
                        $child->id
                    )->get();
                @endphp

                @if($grandChildren->count())

                    <ul class="ml-6">

                        @foreach($grandChildren as $grandChild)

                            <li>
                                ↳ {{ $grandChild->name }}
                            </li>

                        @endforeach

                    </ul>

                @endif

            </li>

        @endforeach

    </ul>

@endif

                </li>

            @endforeach

        </ul>

    </div>

</div> -->


    <!-- Recent Income -->

    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">



        <div class="bg-gradient-to-r from-[#0A2E6F] via-[#124A9E] to-[#1FA97A] px-6 py-4">

            <h4 class="text-xl font-bold text-white">

                Recent Income

            </h4>

        </div>



        <div class="p-6">



            <div class="overflow-x-auto">



                <table class="w-full border-collapse">



                    <thead>

                        <tr class="bg-[#EAF7F2] text-[#0A2E6F]">

                            <th class="border border-gray-200 px-4 py-3 text-left">Amount</th>

                            <th class="border border-gray-200 px-4 py-3 text-left">Type</th>

                            <th class="border border-gray-200 px-4 py-3 text-left">Date</th>

                        </tr>

                    </thead>



                    <tbody>



                        @forelse($recentIncome as $income)



                        <tr class="hover:bg-[#F4FBF8] transition">



                            <td class="border border-gray-200 px-4 py-3 font-bold text-[#1FA97A]">

                                ₹{{ number_format($income->amount,2) }}

                            </td>



                            <td class="border border-gray-200 px-4 py-3">

                                {{ ucfirst(str_replace('_',' ',$income->type)) }}

                            </td>



                            <td class="border border-gray-200 px-4 py-3">

                                {{ $income->created_at }}

                            </td>



                        </tr>



                        @empty



                        <tr>

                            <td colspan="3" class="border border-gray-200 px-4 py-4 text-center text-gray-500">

                                No Income Found

                            </td>

                        </tr>



                        @endforelse



                    </tbody>



                </table>



            </div>



        </div>



    </div>


    <!-- Recent Withdrawals -->

    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">



        <div class="bg-gradient-to-r from-[#0A2E6F] via-[#124A9E] to-[#1FA97A] px-6 py-4">

            <h4 class="text-xl font-bold text-white">

                Recent Withdrawals

            </h4>

        </div>



        <div class="p-6">



            <div class="overflow-x-auto">



                <table class="w-full border-collapse">



                    <thead>

                        <tr class="bg-[#EAF7F2] text-[#0A2E6F]">

                            <th class="border border-gray-200 px-4 py-3 text-left">Amount</th>

                            <th class="border border-gray-200 px-4 py-3 text-left">Status</th>

                            <th class="border border-gray-200 px-4 py-3 text-left">Date</th>

                        </tr>

                    </thead>



                    <tbody>



                        @forelse($recentWithdrawals as $withdrawal)



                        <tr class="hover:bg-[#F4FBF8] transition">



                            <td class="border border-gray-200 px-4 py-3 font-bold text-[#1FA97A]">

                                ₹{{ number_format($withdrawal->amount,2) }}

                            </td>



                            <td class="border border-gray-200 px-4 py-3">



                                @if($withdrawal->status=='approved')



                                    <span class="px-3 py-1 rounded-full text-sm bg-green-100 text-green-700 font-semibold">

                                        Approved

                                    </span>



                                @elseif($withdrawal->status=='pending')



                                    <span class="px-3 py-1 rounded-full text-sm bg-yellow-100 text-yellow-700 font-semibold">

                                        Pending

                                    </span>



                                @else



                                    <span class="px-3 py-1 rounded-full text-sm bg-red-100 text-red-700 font-semibold">

                                        {{ ucfirst($withdrawal->status) }}

                                    </span>



                                @endif



                            </td>



                            <td class="border border-gray-200 px-4 py-3">

                                {{ $withdrawal->created_at }}

                            </td>



                        </tr>



                        @empty



                        <tr>

                            <td colspan="3" class="border border-gray-200 px-4 py-4 text-center text-gray-500">

                                No Withdrawals Found

                            </td>

                        </tr>



                        @endforelse



                    </tbody>



                </table>



            </div>



        </div>

    </div>
</div>
<!-- RIGHT SIDE -->
<div class="w-full lg:w-4/12 flex justify-center">

    @php

  $completedLevels = 0;

if($level1Valid) $completedLevels++;
if($level2Valid) $completedLevels++;
if($level3Valid) $completedLevels++;
if($level4Valid) $completedLevels++;
if($level5Valid) $completedLevels++;

    $percentage = ($completedLevels / 10) * 100;

    @endphp

    <div class="w-[320px] bg-[#131C4B] rounded-2xl shadow-xl p-5 sticky top-5">

        <h2 class="text-center text-cyan-400 text-xl font-bold mb-4">
            Depth Completed
        </h2>

        <!-- <div class="bg-white p-3 rounded mt-3">

@foreach($level1Users as $member)

    <p>
        {{ $member->name }} -
        {{ $member->sales_count }}
    </p>

@endforeach

</div> -->

        <div class="relative flex flex-col items-center">

            <!-- Background Line -->
            <div class="absolute top-5 bottom-5 w-2 bg-gray-600 rounded-full"></div>

            <!-- Filled Line -->
            <div
                class="absolute top-5 left-1/2 -translate-x-1/2 w-2 bg-green-500 rounded-full"
                style="height: {{ $percentage }}%;">
            </div>

            @for($i = 1; $i <= 10; $i++)

                @php

               $counts = [
    1 => $level1Count,
    2 => $level2Count,
    3 => $level3Count,
    4 => $level4Count,
    5 => $level5Count,
    6 => $level6Count,
    7 => $level7Count,
    8 => $level8Count,
    9 => $level9Count,
    10 => $level10Count,
];

     $required = pow(3, $i);

// Display Count
if($i == 1){
    $displayCount = $level1Display;
}
elseif($i == 2){
    $displayCount = $level2Display;
}
elseif($i == 3){
    $displayCount = $level3Display;
}
elseif($i == 4){
    $displayCount = $level4Display;
}
elseif($i == 5){
    $displayCount = $level5Display;
}
else{
    $displayCount = $counts[$i] ?? 0;
}

// Valid Count (Qualification)
if($i == 1){
    $validCount = $level1Valid;
}
elseif($i == 2){
    $validCount = $level2Valid;
}
elseif($i == 3){
    $validCount = $level3Valid;
}
elseif($i == 4){
    $validCount = $level4Valid;
}
elseif($i == 5){
    $validCount = $level5Valid;
}
else{
    $validCount = $counts[$i] ?? 0;
}

// Color Logic

if($i == 1){

    if($level1Valid){
        $bg = 'bg-green-500';
    }
    elseif($displayCount > 0){
        $bg = 'bg-yellow-400';
    }
    else{
        $bg = 'bg-gray-500';
    }

}
elseif($i == 2){

    if($level2Valid){
        $bg = 'bg-green-500';
    }
    elseif($displayCount > 0){
        $bg = 'bg-yellow-400';
    }
    else{
        $bg = 'bg-gray-500';
    }

}
elseif($i == 3){

    if($level3Valid){
        $bg = 'bg-green-500';
    }
    elseif($displayCount > 0){
        $bg = 'bg-yellow-400';
    }
    else{
        $bg = 'bg-gray-500';
    }

}
elseif($i == 4){

    if($level4Valid){
        $bg = 'bg-green-500';
    }
    elseif($displayCount > 0){
        $bg = 'bg-yellow-400';
    }
    else{
        $bg = 'bg-gray-500';
    }

}
elseif($i == 5){

    if($level5Valid){
        $bg = 'bg-green-500';
    }
    elseif($displayCount > 0){
        $bg = 'bg-yellow-400';
    }
    else{
        $bg = 'bg-gray-500';
    }

}
else{

    if($displayCount > 0){
        $bg = 'bg-yellow-400';
    }
    else{
        $bg = 'bg-gray-500';
    }

}


                @endphp

                <div class="relative group">

                    <div class="w-10 h-10 my-3 rounded-full {{ $bg }} text-white flex items-center justify-center font-bold cursor-pointer">
                        {{ $i }}
                    </div>

                    <div class="hidden group-hover:block absolute z-50 bg-black text-white text-xs p-3 rounded-lg w-80 top-0 left-14">

                        <strong>Level {{ $i }}</strong><br><br>

                       Completed: {{ $displayCount }}/{{ $required }}<br>

                        Remaining: {{ max(0, $required - $displayCount) }}<br><br>

                        🟢 Green = Complete<br>
                        🟡 Yellow = Progress<br>
                        ⚪ Grey = Not Started

                        @if($i == 2)

                        

<hr class="my-2">

@foreach($level1Users as $member)

    <div class="mb-2">

        <strong>{{ $member->name }}</strong>

        @forelse($member->referrals as $child)

            <div class="ml-3">
                └ {{ $child->name }}
            </div>

        @empty

            <div class="ml-3 text-gray-400">
                └ No Member
            </div>

        @endforelse

    </div>

@endforeach

@endif


@if($i == 3)

<hr class="my-2">

@foreach($level1Users as $member)

    <div class="mb-2">
        <strong>{{ $member->name }}</strong>

        @foreach($member->referrals as $child)

            <div class="ml-3">
                └ {{ $child->name }}

                @php
                    $grandChildren = \App\Models\User::where('sponsor_id', $child->id)->get();
                @endphp

                @foreach($grandChildren as $grandChild)
                    <div class="ml-6">
                        └ {{ $grandChild->name }}
                    </div>
                @endforeach

            </div>

        @endforeach

    </div>

@endforeach

@endif





                    </div>

                </div>

            @endfor

        </div>

        <div class="mt-4 text-center text-gray-200 text-sm leading-6">

            Complete your
            <span class="text-cyan-400 font-bold">3 Directs</span>

            to achieve next level

            <div class="mt-3 text-lg font-bold text-white">
                Level 1 : {{ $level1Count }}/3
            </div>

            <div class="text-sm text-gray-300">
                Level 2 : {{ $level2Count }}/9
            </div>

        </div>

    </div>

</div>

       

    </div>

</div>
</div>
</div>
    </div>
</div>

</div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>

<script>
function copyReferralLink() {
    let copyText = document.getElementById("referralLink");

    navigator.clipboard.writeText(copyText.value);

    alert("Referral Link Copied!");
}
</script>

<script>

function copyReferralLink(){

    let text=document.getElementById("referralLink");

    navigator.clipboard.writeText(text.value);

    alert("Referral Link Copied!");

}

function copyCode(){

    navigator.clipboard.writeText("{{ Auth::user()->referral_code }}");

    alert("Referral Code Copied!");

}

</script>
