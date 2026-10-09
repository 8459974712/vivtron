<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
            <div>
                <p class="text-xs font-bold uppercase tracking-[.16em] text-emerald-600">Verification workspace</p>
                <h2 class="mt-1 text-2xl font-bold text-[#0B3B73]">KYC Management</h2>
                <p class="mt-1 text-sm text-slate-500">Review documents, verify identity and keep member records accurate.</p>
            </div>
            <span class="inline-flex w-fit items-center gap-2 rounded-full bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-700">
                <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                {{ $kycs->where('status', 'pending')->count() }} pending reviews
            </span>
        </div>
    </x-slot>

    <div class="kyc-admin-page py-8">
        <style>
            .kyc-admin-page .kyc-shell { display: grid; grid-template-columns: minmax(0, 1.55fr) minmax(20rem, .75fr); gap: 1.25rem; align-items: start; }
            .kyc-admin-page .kyc-table-wrap { max-height: 36rem; overflow: auto; }
            .kyc-admin-page table { min-width: 58rem; border-collapse: separate; border-spacing: 0; }
            .kyc-admin-page thead th { position: sticky; top: 0; z-index: 2; background: #edf7fb; color: #315570; font-size: .68rem; font-weight: 800; letter-spacing: .1em; text-transform: uppercase; }
            .kyc-admin-page tbody tr { transition: background .18s ease; }
            .kyc-admin-page tbody tr:hover, .kyc-admin-page tbody tr.is-selected { background: #f3f9ff; }
            .kyc-admin-page .doc-button { display: inline-flex; align-items: center; gap: .35rem; border: 1px solid #c9dff1; border-radius: .5rem; padding: .4rem .6rem; color: #1268d8; background: #f5faff; font-size: .72rem; font-weight: 800; transition: background .18s ease, border-color .18s ease, transform .18s ease; }
            .kyc-admin-page .doc-button:hover { border-color: #76addb; background: #e6f3ff; transform: translateY(-1px); }
            .kyc-admin-page .queue-search, .kyc-admin-page .queue-filter { min-height: 2.45rem; border: 1px solid #cdddeb; border-radius: .6rem; background: #f9fcff; color: #193e61; font-size: .78rem; outline: none; }
            .kyc-admin-page .queue-search { width: min(17rem, 100%); padding: .6rem .75rem; }
            .kyc-admin-page .queue-filter { padding: .6rem 1.75rem .6rem .7rem; }
            .kyc-admin-page .queue-search:focus, .kyc-admin-page .queue-filter:focus { border-color: #3b8bd9; box-shadow: 0 0 0 4px rgba(59,139,217,.12); }
            .kyc-admin-page .queue-pagination { display: flex; align-items: center; justify-content: space-between; gap: .75rem; border-top: 1px solid #e5eef5; padding: .75rem 1.25rem; background: #fbfdff; }
            .kyc-admin-page .queue-pagination button { min-width: 4.5rem; border: 1px solid #cbddeb; border-radius: .5rem; padding: .4rem .65rem; color: #174873; background: #fff; font-size: .72rem; font-weight: 800; }
            .kyc-admin-page .queue-pagination button:disabled { cursor: not-allowed; opacity: .45; }
            .kyc-admin-page .kyc-preview { position: sticky; top: 1.25rem; min-height: 31rem; }
            .kyc-admin-page .kyc-preview img { display: none; width: 100%; max-height: 24rem; border: 1px solid #d8e6f1; border-radius: .7rem; background: #f7fbff; object-fit: contain; }
            .kyc-admin-page .kyc-preview.has-document img { display: block; }
            .kyc-admin-page .kyc-preview.has-document .preview-empty { display: none; }
            @media (max-width: 1100px) { .kyc-admin-page .kyc-shell { grid-template-columns: 1fr; } .kyc-admin-page .kyc-preview { position: relative; top: auto; } }
        </style>

        <div class="mx-auto max-w-[1500px] px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800">{{ session('success') }}</div>
            @endif

            <div class="kyc-shell">
                <section class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-[0_16px_38px_rgba(13,62,108,.08)]">
                    <div class="flex flex-col justify-between gap-3 border-b border-slate-100 px-5 py-4 sm:flex-row sm:items-center">
                        <div><p class="text-xs font-bold uppercase tracking-[.14em] text-slate-400">Review queue</p><h3 class="mt-1 text-lg font-bold text-[#0B3B73]">Submitted documents</h3></div>
                        <div class="flex flex-col gap-2 sm:flex-row">
                            <input id="kycSearch" type="search" class="queue-search" placeholder="Search user, email or PAN" aria-label="Search KYC requests">
                            <select id="kycStatusFilter" class="queue-filter" aria-label="Filter KYC status"><option value="all">All statuses</option><option value="pending">Pending</option><option value="approved">Approved</option><option value="rejected">Rejected</option></select>
                        </div>
                    </div>

                    <div id="kycTableWrap" class="kyc-table-wrap overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead><tr><th class="px-4 py-3">User</th><th class="px-4 py-3">Aadhaar</th><th class="px-4 py-3">Documents</th><th class="px-4 py-3">PAN</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Action</th></tr></thead>
                            <tbody>
                                @forelse($kycs as $kyc)
                                    @php $status = strtolower($kyc->status); @endphp
                                    <tr class="border-b border-slate-100" data-kyc-row data-status="{{ $status }}">
                                        <td class="px-4 py-4 align-top"><p class="font-bold text-[#0B3B73]">{{ $kyc->user->name }}</p><p class="mt-1 text-xs text-slate-500">{{ $kyc->user->email }}</p></td>
                                        <td class="px-4 py-4 align-top font-semibold text-slate-700">{{ $kyc->aadhaar_number }}</td>
                                        <td class="px-4 py-4 align-top"><div class="flex flex-wrap gap-2">
                                            @if($kyc->aadhaar_front)<button type="button" class="doc-button" data-url="{{ asset('storage/' . $kyc->aadhaar_front) }}" data-title="Aadhaar front" data-user="{{ $kyc->user->name }}" onclick="openKycDocument(this)">Front</button>@endif
                                            @if($kyc->aadhaar_back)<button type="button" class="doc-button" data-url="{{ asset('storage/' . $kyc->aadhaar_back) }}" data-title="Aadhaar back" data-user="{{ $kyc->user->name }}" onclick="openKycDocument(this)">Back</button>@endif
                                        </div></td>
                                        <td class="px-4 py-4 align-top"><p class="font-semibold text-slate-700">{{ $kyc->pan_number }}</p>@if($kyc->pan_image)<button type="button" class="doc-button mt-2" data-url="{{ asset('storage/' . $kyc->pan_image) }}" data-title="PAN card" data-user="{{ $kyc->user->name }}" onclick="openKycDocument(this)">View PAN</button>@endif</td>
                                        <td class="px-4 py-4 align-top"><span class="inline-flex items-center gap-2 rounded-full px-3 py-1.5 text-xs font-bold {{ $status === 'approved' ? 'bg-emerald-100 text-emerald-700' : ($status === 'rejected' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700') }}"><span class="h-2 w-2 rounded-full {{ $status === 'approved' ? 'bg-emerald-500' : ($status === 'rejected' ? 'bg-rose-500' : 'bg-amber-500') }}"></span>{{ ucfirst($status) }}</span></td>
                                        <td class="px-4 py-4 align-top">@if($status === 'pending')<div class="flex flex-wrap gap-2"><a href="{{ route('admin.kyc.approve', $kyc->id) }}" class="rounded-md bg-emerald-600 px-3 py-1.5 text-xs font-bold text-white transition hover:bg-emerald-700">Approve</a><a href="{{ route('admin.kyc.reject', $kyc->id) }}" class="rounded-md bg-rose-600 px-3 py-1.5 text-xs font-bold text-white transition hover:bg-rose-700">Reject</a></div>@else<span class="text-xs font-semibold text-slate-400">No action needed</span>@endif</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="px-5 py-12 text-center text-sm text-slate-500">No KYC requests found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="queue-pagination"><p id="kycPageInfo" class="text-xs font-semibold text-slate-500">Showing requests</p><div class="flex items-center gap-2"><button type="button" id="kycPrev" disabled>Previous</button><button type="button" id="kycNext" disabled>Next</button></div></div>
                </section>

                <aside id="kycPreview" class="kyc-preview rounded-xl border border-slate-200 bg-white p-5 shadow-[0_16px_38px_rgba(13,62,108,.08)]">
                    <div class="mb-5 flex items-start justify-between gap-3 border-b border-slate-100 pb-4"><div><p class="text-xs font-bold uppercase tracking-[.14em] text-emerald-600">Document inspector</p><h3 id="previewTitle" class="mt-1 text-xl font-bold text-[#0B3B73]">Select a document</h3><p id="previewUser" class="mt-1 text-xs text-slate-500">Choose Front, Back or PAN to preview it here.</p></div><span class="rounded-full bg-blue-50 px-2.5 py-1 text-[11px] font-bold text-blue-700">Admin view</span></div>
                    <div class="preview-empty flex min-h-[22rem] items-center justify-center rounded-lg border border-dashed border-slate-200 bg-slate-50 p-6 text-center text-sm text-slate-500">Document preview will appear in this panel.</div>
                    <img id="previewImage" src="" alt="Selected KYC document"><a id="previewOpen" href="#" target="_blank" class="mt-3 hidden text-center text-xs font-bold text-blue-600 hover:text-blue-800">Open original file in new tab</a>
                </aside>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const search = document.getElementById('kycSearch');
            const filter = document.getElementById('kycStatusFilter');
            const rows = Array.from(document.querySelectorAll('[data-kyc-row]'));
            const previous = document.getElementById('kycPrev');
            const next = document.getElementById('kycNext');
            const pageInfo = document.getElementById('kycPageInfo');
            const pageSize = 8;
            let page = 1;
            if (!search || !filter || !rows.length) return;
            const render = function () {
                const query = search.value.trim().toLowerCase();
                const status = filter.value;
                const matches = rows.filter(row => (!query || row.textContent.toLowerCase().includes(query)) && (status === 'all' || row.dataset.status === status));
                const pages = Math.max(1, Math.ceil(matches.length / pageSize));
                page = Math.min(page, pages);
                rows.forEach(row => row.hidden = true);
                matches.slice((page - 1) * pageSize, page * pageSize).forEach(row => row.hidden = false);
                previous.disabled = page <= 1;
                next.disabled = page >= pages;
                pageInfo.textContent = matches.length ? `Showing ${(page - 1) * pageSize + 1}-${Math.min(page * pageSize, matches.length)} of ${matches.length} requests` : 'No matching requests';
            };
            search.addEventListener('input', () => { page = 1; render(); });
            filter.addEventListener('change', () => { page = 1; render(); });
            previous.addEventListener('click', () => { page -= 1; render(); });
            next.addEventListener('click', () => { page += 1; render(); });
            render();
        });

        function openKycDocument(button) {
            const panel = document.getElementById('kycPreview');
            const image = document.getElementById('previewImage');
            const openLink = document.getElementById('previewOpen');
            document.querySelectorAll('[data-kyc-row]').forEach(row => row.classList.remove('is-selected'));
            button.closest('[data-kyc-row]').classList.add('is-selected');
            document.getElementById('previewTitle').textContent = button.dataset.title;
            document.getElementById('previewUser').textContent = button.dataset.user;
            image.src = button.dataset.url;
            openLink.href = button.dataset.url;
            openLink.classList.remove('hidden');
            panel.classList.add('has-document');
        }
    </script>
</x-app-layout>
