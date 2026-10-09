<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Income History
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h3 class="text-lg font-bold mb-4">
                        My Income History
                    </h3>

                    @if($incomes->count())

                        <table class="w-full border">
                            <thead>
                                <tr>
                                    <th class="border p-2">Amount</th>
                                    <th class="border p-2">Type</th>
                                    <th class="border p-2">Description</th>
                                    <th class="border p-2">Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($incomes as $income)
                                    <tr>
                                        <td class="border p-2">₹{{ $income->amount }}</td>
                                        <td class="border p-2">{{ $income->type }}</td>
                                        <td class="border p-2">{{ $income->description }}</td>
                                        <td class="border p-2">{{ $income->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    @else

                        <p>No Income Found.</p>

                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>