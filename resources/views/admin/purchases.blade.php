<x-app-layout>

<div class="max-w-7xl mx-auto py-6 px-4">

    @if(session('success'))

        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>

    @endif

    <div class="bg-white rounded-lg shadow p-6">

        <h2 class="text-2xl font-bold mb-6">
            Purchase Requests
        </h2>

        <div class="overflow-x-auto">

            <table class="w-full border">

                <thead>

                    <tr class="bg-gray-100">

                        <th class="border p-2">ID</th>
                        <th class="border p-2">Product</th>
                        <th class="border p-2">Customer</th>
                        <th class="border p-2">Amount</th>
                        <th class="border p-2">Payment</th>
                        <th class="border p-2">Slip</th>
                        <th class="border p-2">Status</th>
                        <th class="border p-2">Action</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($purchases as $purchase)

                    <tr>

                        <td class="border p-2">
                            {{ $purchase->id }}
                        </td>

                        <td class="border p-2">
                            {{ $purchase->product->name ?? '-' }}
                        </td>

                        <td class="border p-2">

                            {{ $purchase->full_name }}

                            <br>

                            <small>
                                {{ $purchase->email }}
                            </small>

                        </td>

                       <td class="border p-2">

    <div>
        <strong>Total:</strong><br>
        ₹ {{ number_format($purchase->amount,2) }}
    </div>

    <div class="text-green-600 mt-1">
        <strong>Paid:</strong><br>
        ₹ {{ number_format($purchase->payment_amount ?? 0,2) }}
    </div>

    <div class="text-red-600 mt-1">
        <strong>Remaining:</strong><br>
        ₹ {{ number_format($purchase->amount - ($purchase->payment_amount ?? 0),2) }}
    </div>

</td>

                        <td class="border p-2">

                            {{ $purchase->payment_method }}

                            <br>

                            {{ $purchase->payment_type }}

                        </td>

                        <td class="border p-2">

                            @if($purchase->slip)

                                <a href="{{ asset('storage/'.$purchase->slip) }}"
                                   target="_blank"
                                   class="text-blue-600">

                                    View Slip

                                </a>

                            @else

                                -

                            @endif

                        </td>

                        <td class="border p-2">

                            @if($purchase->status == 'approved')

                                <span class="text-green-600 font-bold">
                                    Approved
                                </span>

                            @elseif($purchase->status == 'rejected')

                                <span class="text-red-600 font-bold">
                                    Rejected
                                </span>

                            @else

                                <span class="text-yellow-600 font-bold">
                                    Pending
                                </span>

                            @endif

                        </td>

                        <td class="border p-2">

                            @if($purchase->status == 'pending')

                                <a href="{{ route('purchase.approve',$purchase->id) }}"
                                   class="bg-green-600 text-white px-3 py-1 rounded">

                                    Approve

                                </a>

                                <a href="{{ route('purchase.reject',$purchase->id) }}"
                                   class="bg-red-600 text-white px-3 py-1 rounded ml-2">

                                    Reject

                                </a>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8"
                            class="text-center p-4">

                            No Purchase Found

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>