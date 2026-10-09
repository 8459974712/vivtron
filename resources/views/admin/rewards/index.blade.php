<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reward Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h3 class="text-lg font-bold mb-4">
                        User Rewards
                    </h3>

                    <table class="w-full border">
                        <thead>
                            <tr>
                                <th class="border p-2">ID</th>
                                <th class="border p-2">User</th>
                                <th class="border p-2">Rank</th>
                                <th class="border p-2">Reward Amount</th>
                                <th class="border p-2">Status</th>
                                <th class="border p-2">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($rewards as $reward)
                                <tr>
                                    <td class="border p-2">
                                        {{ $reward->id }}
                                    </td>

                                    <td class="border p-2">
                                        {{ $reward->user->name }}
                                    </td>

                                    <td class="border p-2">
                                        {{ $reward->reward->rank_name }}
                                    </td>

                                    <td class="border p-2">
                                        ₹{{ number_format($reward->reward->reward_amount, 2) }}
                                    </td>

                                    <td class="border p-2">
                                        {{ ucfirst($reward->status) }}
                                    </td>

                                    <td class="border p-2">

                                        @if($reward->status == 'pending')

                                            <a href="{{ route('admin.reward.approve', $reward->id) }}"
                                               class="bg-green-500 text-white px-3 py-1 rounded">
                                                Approve
                                            </a>

                                        @elseif($reward->status == 'approved')

                                            <a href="{{ route('admin.reward.paid', $reward->id) }}"
                                               class="bg-blue-500 text-white px-3 py-1 rounded">
                                                Mark Paid
                                            </a>

                                        @else

                                            Paid

                                        @endif

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border p-2 text-center">
                                        No Rewards Found
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>