<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bank Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto">

            @if(session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded shadow">

                <form method="POST" action="{{ route('bank.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label>Account Holder Name</label>
                        <input type="text"
                               name="account_holder_name"
                               class="w-full border rounded p-2"
                               required>
                    </div>

                    <div class="mb-4">
                        <label>Bank Name</label>
                        <input type="text"
                               name="bank_name"
                               class="w-full border rounded p-2"
                               required>
                    </div>

                    <div class="mb-4">
                        <label>Account Number</label>
                        <input type="text"
                               name="account_number"
                               class="w-full border rounded p-2"
                               required>
                    </div>

                    <div class="mb-4">
                        <label>IFSC Code</label>
                        <input type="text"
                               name="ifsc_code"
                               class="w-full border rounded p-2"
                               required>
                    </div>

                    <button class="bg-blue-500 text-white px-4 py-2 rounded" style="background-color: red;}"> Save Bank Details </button>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>