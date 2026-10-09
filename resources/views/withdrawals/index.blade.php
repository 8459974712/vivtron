<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h2 class="text-2xl font-bold mb-6">
                    Withdrawal Request
                </h2>

                <h3 class="mb-4 text-lg font-semibold">
                    Wallet Balance:
                    ₹{{ auth()->user()->wallet_balance }}
                </h3>

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('withdrawals.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium">
                            Amount
                        </label>

                        <input
                            type="number"
                            name="amount"
                            class="border rounded w-full p-2"
                            required
                        >
                    </div>

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded"
                    >
                        Submit Withdrawal
                    </button>
                </form>

                <hr class="my-6">

                <h3 class="text-xl font-bold mb-4">
                    Withdrawal History
                </h3>

                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Amount</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($withdrawals as $withdrawal)
                            <tr>
                                <td class="border p-2">{{ $withdrawal->id }}</td>
                                <td class="border p-2">₹{{ $withdrawal->amount }}</td>
                                <td class="border p-2">{{ $withdrawal->status }}</td>
                                <td class="border p-2">{{ $withdrawal->created_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="border p-2 text-center">
                                    No Withdrawal Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</x-app-layout>