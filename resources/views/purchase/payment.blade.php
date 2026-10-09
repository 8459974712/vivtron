<x-app-layout>

<div class="max-w-5xl mx-auto py-6 px-4">

    <div class="bg-white rounded-lg shadow p-6">

        <h2 class="text-2xl font-bold mb-6">
            Payment Information
        </h2>

        <div class="mb-6 p-4 border rounded bg-gray-50">

            <h3 class="font-bold text-lg mb-3">
                Selected Product
            </h3>

            <p><strong>{{ $product->name }}</strong></p>

            <div class="grid grid-cols-2 gap-2 mt-3">

                <div>Price</div>
                <div>₹ {{ number_format($product->price,2) }}</div>

                <div>Product Tax</div>
                <div>₹ {{ number_format($product->product_tax,2) }}</div>

                <div>Shipping</div>
                <div>₹ {{ number_format($product->shipping,2) }}</div>

                <div>Shipping Tax</div>
                <div>₹ {{ number_format($product->shipping_tax,2) }}</div>

                <div>Processing Fee</div>
                <div>₹ {{ number_format($product->processing_fee,2) }}</div>

                <div class="font-bold">Total Amount</div>
                <div class="font-bold text-green-600">

                    ₹ {{
                        number_format(
                            $product->price +
                            $product->product_tax +
                            $product->shipping +
                            $product->shipping_tax +
                            $product->processing_fee,
                            2
                        )
                    }}

                </div>

            </div>

        </div>

        <form method="POST"
              action="{{ route('purchase.save') }}"
              enctype="multipart/form-data">

            @csrf

            <div class="mb-4">

                <label class="font-semibold block mb-2">
                    Payment Method
                </label>

                <label class="mr-5">
                    <input type="radio"
                           name="payment_method"
                           value="RTGS"
                           required>
                    RTGS
                </label>

                <label class="mr-5">
                    <input type="radio"
                           name="payment_method"
                           value="NEFT">
                    NEFT
                </label>

                <label>
                    <input type="radio"
                           name="payment_method"
                           value="Cheque">
                    Cheque
                </label>

            </div>

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <label>Payer Name</label>
                    <input type="text"
                           name="payer_name"
                           class="w-full border rounded p-2"
                           required>
                </div>

                <div>
                    <label>Bank Name</label>
                    <input type="text"
                           name="bank_name"
                           class="w-full border rounded p-2"
                           required>
                </div>

                <div>
                    <label>Account Number</label>
                    <input type="text"
                           name="account_number"
                           class="w-full border rounded p-2"
                           required>
                </div>

                <div>
                    <label>Transaction Number</label>
                    <input type="text"
                           name="transaction_number"
                           class="w-full border rounded p-2"
                           required>
                </div>

                <div>
                    <label>Payment Date</label>
                    <input type="date"
                           name="payment_date"
                           class="w-full border rounded p-2"
                           required>
                </div>

                <div>
                    <label>Payment Amount</label>
                    <input type="number"
                           step="0.01"
                           name="payment_amount"
                           class="w-full border rounded p-2"
                           required>
                </div>

            </div>

            <div class="mt-4">

                <label>Upload Payment Slip</label>

                <input type="file"
                       name="slip"
                       class="w-full border rounded p-2"
                       required>

            </div>

            <div class="mt-4">

                <label class="font-semibold block mb-2">
                    Payment Type
                </label>

                <label class="mr-5">
                    <input type="radio"
                           name="payment_type"
                           value="full"
                           required>
                    Full Payment
                </label>

                <label>
                    <input type="radio"
                           name="payment_type"
                           value="half">
                    Half Payment
                </label>

            </div>

            <button
                type="submit"
                class="mt-6 bg-green-600 text-white px-6 py-2 rounded">

                Submit Payment

            </button>

        </form>

    </div>

</div>

</x-app-layout>