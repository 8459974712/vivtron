<x-app-layout>
    @php
        $mapStations = $occupiedStations->map(fn ($station) => [
            'id' => $station->id,
            'lat' => (float) $station->latitude,
            'lng' => (float) $station->longitude,
            'name' => $station->station_name ?: 'Recharge station',
            'address' => $station->address,
        ])->values();
    @endphp

    @if($mapToken)
        <script src="https://sdk.mappls.com/map/sdk/web?v=3.0&access_token={{ rawurlencode($mapToken) }}"></script>
    @endif

    <div class="mx-auto max-w-7xl space-y-6 px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[.16em] text-emerald-600">Location network</p>
                <h1 class="mt-2 text-3xl font-bold text-[#0B3B73]">Recharge Station Locations</h1>
                <p class="mt-2 max-w-2xl text-sm text-slate-500">Register your station location once. Occupied locations remain visible so the network stays clear for everyone.</p>
            </div>
            <span class="inline-flex w-fit items-center gap-2 rounded-full bg-emerald-50 px-4 py-2 text-sm font-semibold text-emerald-700">
                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                {{ $occupiedStations->count() }} occupied locations
            </span>
        </div>

        @if(session('success'))
            <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800">{{ session('error') }}</div>
        @endif

        @if(!$mapToken)
            <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5 text-sm text-amber-900">
                <p class="font-bold">Map service is being prepared</p>
                <p class="mt-1">The station workflow is ready. Map display and address lookup will activate after the super admin adds the Mappls access token.</p>
            </div>
        @endif

        <div class="grid gap-6 xl:grid-cols-[minmax(0,1.2fr)_minmax(380px,.8fr)]">
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-[0_14px_40px_rgba(13,62,108,.08)]">
                <div class="flex items-center justify-between border-b border-slate-100 px-6 py-5">
                    <div>
                        <h2 class="text-lg font-bold text-[#0B3B73]">Choose station location</h2>
                        <p class="mt-1 text-xs text-slate-500">Click the map, drag the pin, or use your current location.</p>
                    </div>
                    <button type="button" id="useCurrentLocation" class="rounded-lg bg-[#0B3B73] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-[#082d59]">Use my location</button>
                </div>
                @if($mapToken)
                    <div id="stationMap" class="h-[420px] w-full bg-slate-100"></div>
                @else
                    <div class="flex h-[420px] items-center justify-center bg-slate-50 px-8 text-center text-sm text-slate-500">Map will appear here after Mappls token setup.</div>
                @endif
            </section>

            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_14px_40px_rgba(13,62,108,.08)]">
                <div class="mb-5">
                    <h2 class="text-lg font-bold text-[#0B3B73]">Register station</h2>
                    <p class="mt-1 text-xs text-slate-500">A location within 100 meters of an existing station cannot be registered.</p>
                </div>
                <form method="POST" action="{{ route('stations.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="station_name" class="mb-1.5 block text-sm font-semibold text-slate-700">Station name <span class="font-normal text-slate-400">(optional)</span></label>
                        <input id="station_name" name="station_name" value="{{ old('station_name') }}" class="w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-[#1268D8] focus:ring-[#1268D8]" placeholder="Example: Vivtron EVCS - Main Road">
                    </div>
                    <div>
                        <label for="address" class="mb-1.5 block text-sm font-semibold text-slate-700">Location address</label>
                        <textarea id="address" name="address" rows="3" class="w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-[#1268D8] focus:ring-[#1268D8]" placeholder="Address will be filled from Mappls, or enter it manually">{{ old('address') }}</textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="latitude" class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Latitude</label>
                            <input id="latitude" name="latitude" value="{{ old('latitude') }}" required readonly class="w-full rounded-lg border-slate-300 bg-slate-50 text-sm shadow-sm">
                        </div>
                        <div>
                            <label for="longitude" class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-500">Longitude</label>
                            <input id="longitude" name="longitude" value="{{ old('longitude') }}" required readonly class="w-full rounded-lg border-slate-300 bg-slate-50 text-sm shadow-sm">
                        </div>
                    </div>
                    @if($errors->any())
                        <div class="rounded-lg bg-rose-50 px-3 py-2 text-xs text-rose-700">{{ $errors->first() }}</div>
                    @endif
                    <button type="submit" class="w-full rounded-lg bg-[#13A86B] px-4 py-3 text-sm font-bold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-[#0d925b]">Register this location</button>
                </form>
            </section>
        </div>

        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_14px_40px_rgba(13,62,108,.08)]">
            <div class="mb-5 flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-lg font-bold text-[#0B3B73]">Occupied locations</h2>
                    <p class="mt-1 text-xs text-slate-500">Visible to all registered users. Owner details remain private here.</p>
                </div>
                <span class="rounded-lg bg-slate-50 px-3 py-2 text-sm font-semibold text-slate-600">{{ $occupiedStations->count() }} total</span>
            </div>
            <div class="grid gap-3 md:grid-cols-2 xl:grid-cols-3">
                @forelse($occupiedStations as $station)
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="font-bold text-[#0B3B73]">{{ $station->station_name ?: 'Recharge station' }}</p>
                                <p class="mt-1 line-clamp-2 text-xs text-slate-500">{{ $station->address ?: 'Address available on map' }}</p>
                            </div>
                            <span class="shrink-0 rounded-full bg-emerald-100 px-2.5 py-1 text-[11px] font-bold text-emerald-700">Occupied</span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">No station locations have been registered yet.</p>
                @endforelse
            </div>
        </section>
    </div>

    @if($mapToken)
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const occupied = @json($mapStations);
                const map = new mappls.Map('stationMap', {
                    center: { lat: 22.9734, lng: 78.6569 },
                    zoom: 5,
                    zoomControl: true,
                    fullscreenControl: true,
                });
                let selectedMarker = null;

                const setCoordinates = (lat, lng, center = true) => {
                    document.getElementById('latitude').value = Number(lat).toFixed(7);
                    document.getElementById('longitude').value = Number(lng).toFixed(7);
                    if (selectedMarker && selectedMarker.setPosition) {
                        selectedMarker.setPosition({ lat: Number(lat), lng: Number(lng) });
                    } else {
                        selectedMarker = new mappls.Marker({
                            map,
                            position: { lat: Number(lat), lng: Number(lng) },
                            draggable: true,
                        });
                    }
                    if (center) map.setCenter({ lat: Number(lat), lng: Number(lng) });
                    fetch(`{{ route('stations.reverse-geocode') }}?lat=${encodeURIComponent(lat)}&lng=${encodeURIComponent(lng)}`, { headers: { 'Accept': 'application/json' } })
                        .then(response => response.ok ? response.json() : null)
                        .then(data => { if (data && data.address) document.getElementById('address').value = data.address; })
                        .catch(() => {});
                };

                occupied.forEach(station => new mappls.Marker({
                    map,
                    position: { lat: Number(station.lat), lng: Number(station.lng) },
                }));

                map.addListener('click', function (event) {
                    const point = event.lngLat || event.latLng || event;
                    const lat = point.lat ?? point.latitude;
                    const lng = point.lng ?? point.lon ?? point.longitude;
                    if (lat !== undefined && lng !== undefined) setCoordinates(lat, lng);
                });

                document.getElementById('useCurrentLocation').addEventListener('click', function () {
                    if (!navigator.geolocation) return alert('Location is not supported by this browser.');
                    navigator.geolocation.getCurrentPosition(
                        position => setCoordinates(position.coords.latitude, position.coords.longitude),
                        () => alert('Please allow location access, or select the location manually on the map.'),
                        { enableHighAccuracy: true, timeout: 10000 }
                    );
                });
            });
        </script>
    @endif
</x-app-layout>
