<x-app-layout>
    <style>
        .bank-admin-page .bank-card { overflow: hidden; border: 1px solid #dce8f3; border-radius: .75rem; background: #fff; box-shadow: 0 16px 38px rgba(13,62,108,.08); }
        .bank-admin-page .bank-table-wrap { max-height: 36rem; overflow: auto; }
        .bank-admin-page table { min-width: 70rem; border-collapse: separate; border-spacing: 0; }
        .bank-admin-page thead th { position: sticky; top: 0; z-index: 2; background: #edf7fb; color: #315570; font-size: .68rem; font-weight: 800; letter-spacing: .1em; text-transform: uppercase; }
        .bank-admin-page tbody tr:hover { background: #f5faff; }
        .bank-admin-page .bank-search, .bank-admin-page .bank-filter { min-height: 2.45rem; border: 1px solid #cdddeb; border-radius: .6rem; background: #f9fcff; color: #193e61; font-size: .78rem; outline: none; }
        .bank-admin-page .bank-search { width: min(18rem, 100%); padding: .6rem .75rem; }
        .bank-admin-page .bank-filter { padding: .6rem 1.7rem .6rem .7rem; }
        .bank-admin-page .bank-search:focus, .bank-admin-page .bank-filter:focus { border-color: #3b8bd9; box-shadow: 0 0 0 4px rgba(59,139,217,.12); }
        .bank-admin-page .bank-pagination { display: flex; align-items: center; justify-content: space-between; gap: .75rem; border-top: 1px solid #e5eef5; padding: .75rem 1.25rem; background: #fbfdff; }
        .bank-admin-page .bank-pagination button { min-width: 4.5rem; border: 1px solid #cbddeb; border-radius: .5rem; padding: .4rem .65rem; color: #174873; background: #fff; font-size: .72rem; font-weight: 800; }
        .bank-admin-page .bank-pagination button:disabled { cursor: not-allowed; opacity: .45; }
    </style>

    <div class="bank-admin-page py-12">
        <div class="max-w-7xl mx-auto">

            <div class="bank-card bg-white p-6 rounded shadow">

                <div class="mb-5 flex flex-col justify-between gap-3 border-b border-slate-100 pb-4 sm:flex-row sm:items-center">
                    <div><p class="text-xs font-bold uppercase tracking-[.14em] text-emerald-600">Finance workspace</p><h2 class="mt-1 text-2xl font-bold text-[#0B3B73]">Bank Approval Requests</h2></div>
                    <div class="flex flex-col gap-2 sm:flex-row"><input id="bankSearch" type="search" class="bank-search" placeholder="Search user, bank or IFSC"><select id="bankFilter" class="bank-filter"><option value="all">All statuses</option><option value="pending">Pending</option><option value="approved">Approved</option><option value="rejected">Rejected</option></select></div>
                </div>

                <div class="bank-table-wrap overflow-x-auto"><table class="w-full border">

                    <thead>
                        <tr>
                            <th class="border p-2">User</th>
                            <th class="border p-2">Account Holder</th>
                            <th class="border p-2">Bank</th>
                            <th class="border p-2">Account No</th>
                            <th class="border p-2">IFSC</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Action</th>
                        </tr>
                    </thead>

                    <tbody id="bankTableBody">

                        @foreach($banks as $bank)

                        <tr data-bank-row data-status="{{ strtolower($bank->status) }}">

                            <td class="border p-2">
                                {{ $bank->user->name }}
                            </td>

                            <td class="border p-2">
                                {{ $bank->account_holder_name }}
                            </td>

                            <td class="border p-2">
                                {{ $bank->bank_name }}
                            </td>

                            <td class="border p-2">
                                {{ $bank->account_number }}
                            </td>

                            <td class="border p-2">
                                {{ $bank->ifsc_code }}
                            </td>

                            <td class="border p-2">
                                {{ $bank->status }}
                            </td>

                            <td class="border p-2">

                                @if($bank->status == 'pending')

                                <form action="{{ route('admin.banks.approve', $bank->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button class="bg-green-500 text-white px-2 py-1 rounded">
                                        Approve
                                    </button>
                                </form>

                                <form action="{{ route('admin.banks.reject', $bank->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button class="bg-red-500 text-white px-2 py-1 rounded">
                                        Reject
                                    </button>
                                </form>

                                @else

                                    {{ ucfirst($bank->status) }}

                                @endif

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table></div>
                <div class="bank-pagination"><p id="bankPageInfo" class="text-xs font-semibold text-slate-500">Showing requests</p><div class="flex gap-2"><button type="button" id="bankPrev" disabled>Previous</button><button type="button" id="bankNext" disabled>Next</button></div></div>

            </div>

        </div>
    </div>

</x-app-layout>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const search = document.getElementById('bankSearch'); const filter = document.getElementById('bankFilter'); const rows = Array.from(document.querySelectorAll('[data-bank-row]')); const prev = document.getElementById('bankPrev'); const next = document.getElementById('bankNext'); const info = document.getElementById('bankPageInfo'); let page = 1; const size = 8;
    if (!search || !filter || !rows.length) return;
    const render = function () { const q = search.value.trim().toLowerCase(); const s = filter.value; const matches = rows.filter(row => (!q || row.textContent.toLowerCase().includes(q)) && (s === 'all' || row.dataset.status === s)); const pages = Math.max(1, Math.ceil(matches.length / size)); page = Math.min(page, pages); rows.forEach(row => row.hidden = true); matches.slice((page - 1) * size, page * size).forEach(row => row.hidden = false); prev.disabled = page <= 1; next.disabled = page >= pages; info.textContent = matches.length ? `Showing ${(page - 1) * size + 1}-${Math.min(page * size, matches.length)} of ${matches.length} requests` : 'No matching requests'; };
    search.addEventListener('input', () => { page = 1; render(); }); filter.addEventListener('change', () => { page = 1; render(); }); prev.addEventListener('click', () => { page--; render(); }); next.addEventListener('click', () => { page++; render(); }); render();
});
</script>
