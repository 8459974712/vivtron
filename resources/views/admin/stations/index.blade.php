<x-app-layout>
    @php
        $mapStations = $stations->where('status', 'active')->map(fn ($station) => [
            'lat' => (float) $station->latitude,
            'lng' => (float) $station->longitude,
            'name' => $station->station_name ?: 'Recharge station',
        ])->values();
    @endphp

    @if($mapToken)
        <script src="https://sdk.mappls.com/map/sdk/web?v=3.0&access_token={{ rawurlencode($mapToken) }}"></script>
    @endif

    <div class="mx-auto max-w-7xl space-y-6 px-4 py-8 sm:px-6 lg:px-8">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[.16em] text-emerald-600">Super admin controls</p>
            <h1 class="mt-2 text-3xl font-bold text-[#0B3B73]">Recharge Station Locations</h1>
            <p class="mt-2 text-sm text-slate-500">Manage Mappls integration and review complete owner details for every registered station.</p>
        </div>

        @if(session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">{{ session('success') }}</div>
        @endif

        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_14px_40px_rgba(13,62,108,.08)]">
            <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
                <div>
                    <h2 class="text-lg font-bold text-[#0B3B73]">Mappls configuration</h2>
                    <p class="mt-1 text-xs text-slate-500">Paste the static access token from Mappls Console. It will be stored securely and never shown in plain text.</p>
                </div>
                <span class="rounded-full px-3 py-1.5 text-xs font-bold {{ $mapToken ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">{{ $mapToken ? 'Token configured' : 'Token required' }}</span>
            </div>
            <form method="POST" action="{{ route('admin.mappls.token') }}" class="mt-5 flex flex-col gap-3 md:flex-row">
                @csrf
                <input type="password" name="mappls_access_token" class="min-w-0 flex-1 rounded-lg border-slate-300 text-sm shadow-sm focus:border-[#1268D8] focus:ring-[#1268D8]" placeholder="Mappls static access token">
                <button class="rounded-lg bg-[#0B3B73] px-5 py-3 text-sm font-bold text-white transition hover:-translate-y-0.5 hover:bg-[#082d59]">Save Mappls token</button>
            </form>
            @if($mapToken)
                <form method="POST" action="{{ route('admin.mappls.token') }}" class="mt-3">
                    @csrf
                    <input type="hidden" name="mappls_access_token" value="">
                    <button class="text-xs font-semibold text-rose-600 hover:text-rose-700">Remove configured token</button>
                </form>
            @endif
        </section>

        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-[0_14px_40px_rgba(13,62,108,.08)]">
            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
                <div>
                    <h2 class="text-lg font-bold text-[#0B3B73]">Station map</h2>
                    <p class="mt-1 text-xs text-slate-500">{{ $stations->where('status', 'active')->count() }} active locations visible to users.</p>
                </div>
            </div>
            @if($mapToken)
                <div id="adminStationMap" class="h-[480px] w-full bg-slate-100"></div>
            @else
                <div class="flex h-64 items-center justify-center bg-slate-50 text-sm text-slate-500">Add the Mappls token above to activate the admin map.</div>
            @endif
        </section>

        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-[0_14px_40px_rgba(13,62,108,.08)]">
            <div class="border-b border-slate-100 px-6 py-5">
                <h2 class="text-lg font-bold text-[#0B3B73]">Complete station records</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                        <tr><th class="px-6 py-4">Station</th><th class="px-6 py-4">User</th><th class="px-6 py-4">Contact</th><th class="px-6 py-4">Coordinates</th><th class="px-6 py-4">Status</th><th class="px-6 py-4">Action</th></tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($stations as $station)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4"><p class="font-bold text-[#0B3B73]">{{ $station->station_name ?: 'Recharge station' }}</p><p class="mt-1 max-w-xs text-xs text-slate-500">{{ $station->address ?: 'Address not provided' }}</p></td>
                                <td class="px-6 py-4"><p class="font-semibold text-slate-700">{{ $station->user->name }}</p><p class="text-xs text-slate-500">{{ $station->user->email }}</p></td>
                                <td class="px-6 py-4 text-slate-600">{{ $station->user->mobile ?: 'Not available' }}</td>
                                <td class="px-6 py-4 font-mono text-xs text-slate-600">{{ number_format($station->latitude, 7) }}, {{ number_format($station->longitude, 7) }}</td>
                                <td class="px-6 py-4"><span class="rounded-full px-3 py-1 text-xs font-bold {{ $station->status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ ucfirst($station->status) }}</span></td>
                                <td class="px-6 py-4"><form method="POST" action="{{ route('admin.stations.toggle', $station) }}">@csrf<input type="hidden" name="status" value="{{ $station->status === 'active' ? 'inactive' : 'active' }}"><button class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-bold text-[#0B3B73] hover:bg-slate-50">{{ $station->status === 'active' ? 'Deactivate' : 'Activate' }}</button></form></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-6 py-10 text-center text-sm text-slate-500">No station locations registered yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    @if($mapToken)
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const stations = @json($mapStations);
                const map = new mappls.Map('adminStationMap', { center: { lat: 22.9734, lng: 78.6569 }, zoom: 5, zoomControl: true, fullscreenControl: true });
                stations.forEach(station => new mappls.Marker({ map, position: { lat: Number(station.lat), lng: Number(station.lng) } }));
            });
        </script>
    @endif
</x-app-layout>
