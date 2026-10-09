<x-guest-layout>

    <div class="mb-4 text-sm text-gray-600">
        Your OTP has been sent to your registered mobile number.
    </div>

    <form method="POST" action="{{ route('otp.verify.submit') }}">
        @csrf

        <div>
            <x-input-label for="otp" :value="__('Enter OTP')" />

            <x-text-input
                id="otp"
                class="block mt-1 w-full"
                type="text"
                name="otp"
                maxlength="6"
                minlength="6"
                inputmode="numeric"
                pattern="[0-9]{6}"
                required
                autofocus
                placeholder="Enter 6 digit OTP"
            />

            <x-input-error
                :messages="$errors->get('otp')"
                class="mt-2"
            />
        </div>

        <div class="flex items-center justify-end mt-4">

            <x-primary-button>
                {{ __('Verify OTP') }}
            </x-primary-button>

        </div>

    </form>

</x-guest-layout>