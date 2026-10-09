<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Sales Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-bold mb-4">
                    Add New Sale
                </h3>

                <form method="POST" action="{{ route('sales.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label>User</label>

                        <select
                            name="user_id"
                            class="w-full border rounded p-2"
                            required
                        >
                            <option value="">Select User</option>

                            @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Product Name</label>

                        <input
                            type="text"
                            name="product_name"
                            class="w-full border rounded p-2"
                        >
                    </div>

                    <div class="mb-4">
                        <label>Sale Value</label>

                        <input
                            type="number"
                            name="sale_value"
                            class="w-full border rounded p-2"
                            required
                        >
                    </div>

                    <button
                        type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded"
                    >
                        Add Sale
                    </button>

                </form>

            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6 mt-6">

                <h3 class="text-lg font-bold mb-4">
                    Sales List
                </h3>

                <table class="w-full border">
                    <thead>
                        <tr>
                            <th class="border p-2">Action</th>
                            <th class="border p-2">ID</th>
                            <th class="border p-2">User</th>
                            <th class="border p-2">Product</th>
                            <th class="border p-2">Sale Value</th>
                            <th class="border p-2">Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($sales as $sale)

                        <tr>
                            <td class="border p-2">{{ $sale->id }}</td>

                            <td class="border p-2">
                                {{ $sale->user->name }}
                            </td>

                            <td class="border p-2">
                                {{ $sale->product_name }}
                            </td>

                            <td class="border p-2">
                                ₹{{ number_format($sale->sale_value,2) }}
                            </td>

                            <td class="border p-2">
                                {{ ucfirst($sale->status) }}
                            </td>

                            <td class="border p-2">

    <a href="{{ route('sales.approve', $sale->id) }}"
       class="bg-green-500 text-white px-2 py-1 rounded">
       Approve
    </a>

    <a href="{{ route('sales.operational', $sale->id) }}"
       class="bg-blue-500 text-white px-2 py-1 rounded">
       Operational
    </a>

    <a href="{{ route('sales.reject', $sale->id) }}"
       class="bg-red-500 text-white px-2 py-1 rounded">
       Reject
    </a>

</td>
                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</x-app-layout>