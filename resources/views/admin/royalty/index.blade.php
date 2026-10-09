<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Royalty Income Settings
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded p-6 mb-6">

                <form method="POST"
                      action="{{ route('admin.royalty.settings.store') }}">

                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <input type="text"
                               name="title"
                               placeholder="Royalty Title"
                               class="border p-2 rounded"
                               required>

                        <input type="number"
                               name="required_sales"
                               placeholder="Required Sales"
                               class="border p-2 rounded"
                               required>

                        <input type="number"
                               step="0.01"
                               name="percentage"
                               placeholder="Percentage"
                               class="border p-2 rounded"
                               required>

                    </div>

                    <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded mt-4">
                        Add Royalty
                    </button>

                </form>

            </div>

            <div class="bg-white shadow rounded p-6">

                <h3 class="font-bold text-lg mb-4">
                    Royalty List
                </h3>

                <table class="w-full border">

                    <thead>
                        <tr>
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Title</th>
                            <th class="border p-2">Required Sales</th>
                            <th class="border p-2">Percentage</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($royalties as $royalty)

                            <tr>
                                <td class="border p-2">
                                    {{ $royalty->id }}
                                </td>

                                <td class="border p-2">
                                    {{ $royalty->title }}
                                </td>

                                <td class="border p-2">
                                    {{ $royalty->required_sales }}
                                </td>

                                <td class="border p-2">
                                    {{ $royalty->percentage }}%
                                </td>

                                <td class="border p-2">
                                    {{ $royalty->status ? 'Active' : 'Inactive' }}
                                </td>

                                <td class="border p-2">

                                    <a href="{{ route('admin.royalty.settings.delete', $royalty->id) }}"
                                       class="bg-red-500 text-white px-3 py-1 rounded">
                                        Delete
                                    </a>

                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>
    </div>
</x-app-layout>