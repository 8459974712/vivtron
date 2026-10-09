<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h2 class="text-2xl font-bold mb-6">
                    Withdrawal Requests
                </h2>

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">User</th>
                            <th class="border p-2">Amount</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($withdrawals as $withdrawal)
                            <tr>
                                <td class="border p-2">{{ $withdrawal->id }}</td>
                                <td class="border p-2">{{ $withdrawal->user->name }}</td>
                                <td class="border p-2">₹{{ $withdrawal->amount }}</td>
                                <td class="border p-2">{{ $withdrawal->status }}</td>
                                <td class="border p-2">

                                    @if($withdrawal->status == 'pending')

                                        <a href="{{ route('admin.withdrawal.approve', $withdrawal->id) }}"
                                           class="bg-green-500 text-white px-3 py-1 rounded">
                                            Approve
                                        </a>

                                        <a href="{{ route('admin.withdrawal.reject', $withdrawal->id) }}"
                                           class="bg-red-500 text-white px-3 py-1 rounded">
                                            Reject
                                        </a>

                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>
    </div>
</x-app-layout>