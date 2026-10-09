<x-app-layout>

<div class="max-w-7xl mx-auto py-6 px-4">

    <div class="bg-white rounded-lg shadow p-6">

        <h2 class="text-2xl font-bold mb-6">
            My Purchases
        </h2>

<table class="w-full border">

    <thead>

        <tr class="bg-gray-100">

            <th class="border p-2">Product</th>
            <th class="border p-2">Amount</th>
            <th class="border p-2">Payment</th>
            <th class="border p-2">Status</th>
            <th class="border p-2">Date</th>
            <th class="border p-2">Action</th>

        </tr>

    </thead>

    <tbody>

        @forelse($purchases as $purchase)

        <tr>

            <td class="border p-2">
                {{ $purchase->product->name ?? '-' }}
            </td>

            <td class="border p-2">

                <div>
                    <strong>Total:</strong>
                    ₹ {{ number_format($purchase->amount,2) }}
                </div>

                <div class="text-green-600">
                    <strong>Paid:</strong>
                    ₹ {{ number_format($purchase->payment_amount ?? 0,2) }}
                </div>

                <div class="text-red-600">
                    <strong>Remaining:</strong>
                    ₹ {{ number_format($purchase->amount - ($purchase->payment_amount ?? 0),2) }}
                </div>

            </td>

            <td class="border p-2">
                {{ $purchase->payment_method }}
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
                {{ $purchase->created_at->format('d-m-Y') }}
            </td>

            <td class="border p-2">

                @php
                    $remaining = $purchase->amount - ($purchase->payment_amount ?? 0);
                @endphp

                @if($remaining > 0)

                    <a href="{{ route('purchase.remaining.form',$purchase->id) }}"
                       class="bg-blue-600 text-white px-3 py-1 rounded">

                        Pay Remaining

                    </a>

                @else

                    <span class="text-green-600 font-bold">
                        Fully Paid
                    </span>

                @endif

            </td>

        </tr>

        @empty

        <tr>
            <td colspan="6" class="text-center p-4">
                No Purchases Found
            </td>
        </tr>

        @endforelse

    </tbody>

</table>

    </div>

</div>

</x-app-layout>