<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Rank Settings
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded p-6">

                <h3 class="font-bold text-lg mb-4">
                    Rank List
                </h3>

                <table class="w-full border">
                    <thead>
                        <tr>
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Rank Name</th>
                            <th class="border p-2">Required Sales</th>
                            <th class="border p-2">Incentive %</th>
                            <th class="border p-2">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($ranks as $rank)
                            <tr>
                                <td class="border p-2">{{ $rank->id }}</td>
                                <td class="border p-2">{{ $rank->rank_name }}</td>
                                <td class="border p-2">{{ $rank->required_sales }}</td>
                                <td class="border p-2">{{ $rank->incentive_percentage }}</td>
                                <td class="border p-2">
                                    {{ $rank->status ? 'Active' : 'Inactive' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>
    </div>
</x-app-layout>