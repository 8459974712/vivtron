<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manual Income Adjustment
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded p-6 mb-6">
                <form method="POST" action="{{ route('admin.income.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <select name="user_id" class="border p-2 rounded" required>
                            <option value="">Select User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>

                        <input type="number"
                               step="0.01"
                               name="amount"
                               placeholder="Amount"
                               class="border p-2 rounded"
                               required>

                        <input type="text"
                               name="description"
                               placeholder="Description"
                               class="border p-2 rounded"
                               required>

                    </div>

                    <button type="submit"
                            class="bg-green-500 text-white px-4 py-2 rounded mt-4">
                        Add Income
                    </button>
                </form>
            </div>

            <div class="bg-white shadow rounded p-6">
                 <div class="flex justify-between items-center mb-4">
        <h3 class="font-bold text-lg">
            Income History
        </h3>

        <a href="{{ route('admin.income.export') }}"
           class="bg-green-500 text-white px-4 py-2 rounded">
            Export Excel
        </a>
    </div>

                <table class="w-full border">
                    <thead>
                        <tr>
                            <th class="border p-2">ID</th>
                            <th class="border p-2">User ID</th>
                            <th class="border p-2">Amount</th>
                            <th class="border p-2">Type</th>
                            <th class="border p-2">Description</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($incomes as $income)
                            <tr>
                                <td class="border p-2">{{ $income->id }}</td>
                                <td class="border p-2">{{ $income->user_id }}</td>
                                <td class="border p-2">₹{{ $income->amount }}</td>
                                <td class="border p-2">{{ $income->type }}</td>
                                <td class="border p-2">{{ $income->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</x-app-layout>