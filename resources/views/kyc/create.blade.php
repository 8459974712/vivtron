<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            KYC Verification
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg">
                <div class="p-6">

                    <div class="mb-7 flex flex-col justify-between gap-3 border-b border-slate-100 pb-5 sm:flex-row sm:items-center">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-[.16em] text-emerald-600">Account verification</p>
                            <h3 class="mt-1 text-2xl font-bold text-[#0B3B73]">Complete your KYC</h3>
                            <p class="mt-1 text-sm text-slate-500">Upload clear documents to activate secure account services.</p>
                        </div>
                        @if($kyc)
                            <span class="inline-flex w-fit items-center gap-2 rounded-full px-3 py-1.5 text-xs font-bold {{ $kyc->status === 'approved' ? 'bg-emerald-50 text-emerald-700' : ($kyc->status === 'rejected' ? 'bg-rose-50 text-rose-700' : 'bg-amber-50 text-amber-700') }}">
                                <span class="h-2 w-2 rounded-full {{ $kyc->status === 'approved' ? 'bg-emerald-500' : ($kyc->status === 'rejected' ? 'bg-rose-500' : 'bg-amber-500') }}"></span>
                                {{ ucfirst($kyc->status) }}
                            </span>
                        @endif
                    </div>

                    @if($kyc)
                        <div class="mb-7 rounded-xl border border-slate-200 bg-slate-50/70 p-4">
                            <div class="mb-4 flex items-center justify-between gap-3">
                                <div>
                                    <h4 class="font-bold text-[#0B3B73]">Submitted documents</h4>
                                    <p class="mt-1 text-xs text-slate-500">Your latest uploaded information is shown below.</p>
                                </div>
                                <span class="text-xs font-semibold text-slate-500">{{ optional($kyc->updated_at)->format('d M Y, h:i A') }}</span>
                            </div>
                            <div class="grid gap-3 sm:grid-cols-3">
                                <div class="rounded-lg border border-slate-200 bg-white p-3">
                                    <p class="text-[11px] font-bold uppercase tracking-wide text-slate-400">Aadhaar</p>
                                    <p class="mt-1 font-semibold text-slate-700">{{ substr($kyc->aadhaar_number, 0, 4) }} **** {{ substr($kyc->aadhaar_number, -4) }}</p>
                                    <a href="{{ asset('storage/' . $kyc->aadhaar_front) }}" target="_blank" class="mt-2 inline-flex text-xs font-bold text-blue-600 hover:text-blue-800">View front file</a>
                                </div>
                                <div class="rounded-lg border border-slate-200 bg-white p-3">
                                    <p class="text-[11px] font-bold uppercase tracking-wide text-slate-400">Aadhaar back</p>
                                    <p class="mt-1 font-semibold text-emerald-700">Uploaded</p>
                                    <a href="{{ asset('storage/' . $kyc->aadhaar_back) }}" target="_blank" class="mt-2 inline-flex text-xs font-bold text-blue-600 hover:text-blue-800">View back file</a>
                                </div>
                                <div class="rounded-lg border border-slate-200 bg-white p-3">
                                    <p class="text-[11px] font-bold uppercase tracking-wide text-slate-400">PAN card</p>
                                    <p class="mt-1 font-semibold text-slate-700">{{ $kyc->pan_number }}</p>
                                    <a href="{{ asset('storage/' . $kyc->pan_image) }}" target="_blank" class="mt-2 inline-flex text-xs font-bold text-blue-600 hover:text-blue-800">View PAN file</a>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form
                        method="POST"
                        action="{{ route('kyc.store') }}"
                        enctype="multipart/form-data"
                    >
                        @csrf

                        {{-- Aadhaar Number --}}
                        <div class="mb-4">
                            <label class="block font-medium mb-1">
                                Aadhaar Number
                            </label>

                            <input
                                type="text"
                                name="aadhaar_number"
                                maxlength="12"
                                minlength="12"
                                class="w-full border rounded p-2"
                                placeholder="Enter 12 digit Aadhaar Number"
                                required
                            >
                        </div>

                        {{-- Aadhaar Front --}}
                        <div class="mb-4">
                            <label class="block font-medium mb-1">
                                Aadhaar Front Image
                            </label>

                            <input
                                type="file"
                                name="aadhaar_front"
                                accept="image/jpeg,image/png"
                                class="w-full border rounded p-2"
                                required
                            >

                            <p class="text-sm text-gray-500 mt-1">
                                JPG, JPEG or PNG. Maximum size 2 MB.
                            </p>
                        </div>

                        {{-- Aadhaar Back --}}
                        <div class="mb-4">
                            <label class="block font-medium mb-1">
                                Aadhaar Back Image
                            </label>

                            <input
                                type="file"
                                name="aadhaar_back"
                                accept="image/jpeg,image/png"
                                class="w-full border rounded p-2"
                                required
                            >

                            <p class="text-sm text-gray-500 mt-1">
                                JPG, JPEG or PNG. Maximum size 2 MB.
                            </p>
                        </div>

                        {{-- PAN Number --}}
                        <div class="mb-4">
                            <label class="block font-medium mb-1">
                                PAN Number
                            </label>

                            <input
                                type="text"
                                name="pan_number"
                                maxlength="10"
                                class="w-full border rounded p-2 uppercase"
                                placeholder="Enter PAN Number"
                                required
                            >
                        </div>

                        {{-- PAN Image --}}
                        <div class="mb-4">
                            <label class="block font-medium mb-1">
                                PAN Card Image
                            </label>

                            <input
                                type="file"
                                name="pan_image"
                                accept="image/jpeg,image/png"
                                class="w-full border rounded p-2"
                                required
                            >

                            <p class="text-sm text-gray-500 mt-1">
                                JPG, JPEG or PNG. Maximum size 2 MB.
                            </p>
                        </div>

                        <button
                            type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded"
                        >
                            Submit KYC
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
