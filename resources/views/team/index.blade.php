<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            My Team
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto px-4">

            <div class="bg-white shadow rounded-lg p-6">


            

                <h3 class="text-lg font-bold mb-4">
                    Direct Team Members
                </h3>

                <table class="w-full border">

                    <thead>

                        <tr class="bg-gray-100">

                            <th class="border p-2">Name</th>
                            <th class="border p-2">Email</th>
                            <th class="border p-2">Referral Code</th>
                            <th class="border p-2">Join Date</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($directTeam as $member)

                            <tr>

                                <td class="border p-2">
                                    {{ $member->name }}
                                </td>

                                <td class="border p-2">
                                    {{ $member->email }}
                                </td>

                                <td class="border p-2 font-bold">
                                    {{ $member->referral_code }}
                                </td>

                                <td class="border p-2">
                                    {{ \Carbon\Carbon::parse($member->joining_date)->format('d-m-Y') }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4"
                                    class="text-center p-4">

                                    No Team Members Found

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>