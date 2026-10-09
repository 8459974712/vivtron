<x-app-layout>

    <div class="max-w-7xl mx-auto py-6 px-4">

        <div class="bg-white shadow rounded-lg p-6">

            <h2 class="text-2xl font-bold mb-6">
                Product Purchase
            </h2>

             @if(session('success'))

        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">

            {{ session('success') }}

        </div>

    @endif

            <form method="POST" action="{{ route('purchase.store') }}">
                @csrf

                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <label>Full Name</label>
                        <input type="text"
                               name="full_name"
                               class="w-full border rounded p-2"
                               value="{{ auth()->user()->name }}">
                    </div>

                    <div>
                        <label>Email</label>
                        <input type="email"
                               name="email"
                               class="w-full border rounded p-2"
                               value="{{ auth()->user()->email }}">
                    </div>

                    <div>
                        <label>Mobile Number</label>
                        <input type="text"
                               name="mobile"
                               class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label>PAN Number</label>
                        <input type="text"
                               name="pan_number"
                               class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label>GST Number</label>
                        <input type="text"
                               name="gst_number"
                               class="w-full border rounded p-2">
                    </div>

                    <!--<div>-->
                    <!--    <label>Sponsor ID</label>-->
                    <!--    <input type="text"-->
                    <!--           name="sponsor_id"-->
                    <!--           class="w-full border rounded p-2">-->
                    <!--</div>-->

                    <!--<div>-->
                    <!--    <label>Enroll ID</label>-->
                    <!--    <input type="text"-->
                    <!--           name="enroll_id"-->
                    <!--           class="w-full border rounded p-2">-->
                    <!--</div>-->

                    <div>
                        <label>State</label>
                        <input type="text"
                               name="state"
                               class="w-full border rounded p-2">
                    </div>

                    <div>
                        <label>Select Product</label>

<select
    id="productSelect"
    name="product_id"
    class="w-full border rounded p-2">

    <option value="">
        Select Product
    </option>

    @foreach($products as $product)

      <option
    value="{{ $product->id }}"
    data-price="{{ $product->price }}"
    data-tax="{{ $product->product_tax }}"
    data-shipping="{{ $product->shipping }}"
    data-shippingtax="{{ $product->shipping_tax }}"
    data-fee="{{ $product->processing_fee }}"
    data-image="{{ asset($product->image) }}">

            {{ $product->name }}

        </option>

    @endforeach

</select>

<!-- Product Details -->

<div id="productDetails"
     class="hidden mt-4 border rounded-lg p-4 bg-gray-50">

    <h3 class="font-bold text-lg mb-3">
        Selected Product Details
    </h3>

     <div class="flex justify-center mb-4">

        <img
    id="productImage"
    src=""
    class="w-64 border rounded-lg hidden">

    </div>

    <div class="grid grid-cols-2 gap-2">

        <div>Price</div>
        <div id="price">0</div>

        <div>Product Tax</div>
        <div id="product_tax">0</div>

        <div>Shipping</div>
        <div id="shipping">0</div>

        <div>Shipping Tax</div>
        <div id="shipping_tax">0</div>

        <div>Processing Fee</div>
        <div id="processing_fee">0</div>

        <div class="font-bold">Total Amount</div>
        <div id="total_amount"
             class="font-bold text-green-600">
            0
        </div>

    </div>

</div>

                    </div>

                </div>

                <button
                    type="submit"
                    class="mt-6 bg-blue-600 text-white px-6 py-2 rounded">

                    Submit

                </button>

            </form>

        </div>

    </div>

    <script>

document.addEventListener('DOMContentLoaded', function () {

    // Indian Number Format
    function formatIndian(num) {
        return new Intl.NumberFormat('en-IN').format(num);
    }

    document.getElementById('productSelect').addEventListener('change', function () {

        let option = this.options[this.selectedIndex];

        if (!this.value) {
            document.getElementById('productDetails').classList.add('hidden');
            return;
        }

        let price = parseFloat(option.dataset.price) || 0;
        let tax = parseFloat(option.dataset.tax) || 0;
        let shipping = parseFloat(option.dataset.shipping) || 0;
        let shippingTax = parseFloat(option.dataset.shippingtax) || 0;
        let fee = parseFloat(option.dataset.fee) || 0;

        let total = price + tax + shipping + shippingTax + fee;

        // Product Image
        let image = option.dataset.image;

        document.getElementById('productImage').src = image;
        document.getElementById('productImage').classList.remove('hidden');

        // Amounts
        document.getElementById('price').innerHTML = '₹ ' + formatIndian(price);
        document.getElementById('product_tax').innerHTML = '₹ ' + formatIndian(tax);
        document.getElementById('shipping').innerHTML = '₹ ' + formatIndian(shipping);
        document.getElementById('shipping_tax').innerHTML = '₹ ' + formatIndian(shippingTax);
        document.getElementById('processing_fee').innerHTML = '₹ ' + formatIndian(fee);
        document.getElementById('total_amount').innerHTML = '₹ ' + formatIndian(total);

        document.getElementById('productDetails').classList.remove('hidden');

    });

});

</script>

</x-app-layout>