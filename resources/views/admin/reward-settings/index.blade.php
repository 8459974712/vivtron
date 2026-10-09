<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reward Settings
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Add Reward -->

            <div class="bg-white shadow rounded p-6 mb-6">

                <h3 class="font-bold text-lg mb-4">
                    Add Reward
                </h3>

                <form method="POST"
                      action="{{ route('admin.reward.settings.store') }}">

                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <input
                            type="text"
                            name="rank_name"
                            placeholder="Rank Name"
                            class="border rounded p-2"
                            required
                        >

                        <input
                            type="number"
                            name="required_sales"
                            placeholder="Required Sales"
                            class="border rounded p-2"
                            required
                        >

                        <input
                            type="number"
                            name="reward_amount"
                            placeholder="Reward Amount"
                            class="border rounded p-2"
                            required
                        >

                    </div>

                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded mt-4"
                    >
                        Add Reward
                    </button>

                </form>

            </div>

            <!-- Reward List -->

            <div class="bg-white shadow rounded p-6">

                <h3 class="font-bold text-lg mb-4">
                    Reward List
                </h3>

                <table class="w-full border">

                    <thead>
                        <tr>
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Rank</th>
                            <th class="border p-2">Required Sales</th>
                            <th class="border p-2">Reward Amount</th>
                            <th class="border p-2">Status</th>
                            <th class="border p-2">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($rewards as $reward)

                            <tr>
                                <td class="border p-2">
                                    {{ $reward->id }}
                                </td>

                                <td class="border p-2">
                                    {{ $reward->rank_name }}
                                </td>

                                <td class="border p-2">
                                    {{ $reward->required_sales }}
                                </td>

                                <td class="border p-2">
                                    ₹{{ $reward->reward_amount }}
                                </td>

                                <td class="border p-2">
                                    {{ $reward->status ? 'Active' : 'Inactive' }}
                                </td>

                                <td class="border p-2">

    <a href="{{ route('admin.reward.settings.edit',$reward->id) }}"
       style="background:orange;color:white;padding:8px 12px;border-radius:5px;margin-right:5px;text-decoration:none;">
        Edit
    </a>

    <a href="{{ route('admin.reward.settings.delete',$reward->id) }}"
       onclick="return confirm('Delete Reward?')"
       class="bg-red-600 text-white px-3 py-1 rounded">
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