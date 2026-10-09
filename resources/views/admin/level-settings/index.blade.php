<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Level Income Settings
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">

            <div class="bg-white p-6 rounded shadow mb-6">

                <form method="POST"
                      action="{{ route('admin.level.settings.store') }}">

                    @csrf

                    <div class="grid grid-cols-2 gap-4">

                        <input type="number"
                               name="level_no"
                               placeholder="Level Number"
                               class="border rounded p-2">

                        <input type="number"
                               step="0.01"
                               name="percentage"
                               placeholder="Percentage"
                               class="border rounded p-2">

                    </div>

                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded mt-4">
                        Add Level
                    </button>

                </form>

            </div>

            <div class="bg-white p-6 rounded shadow">

                <table class="w-full border">

                    <thead>
                        <tr>
                            <th class="border p-2">Level</th>
                            <th class="border p-2">Percentage</th>
                            <th class="border p-2">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach($levels as $level)

                        <tr>
                            <td class="border p-2">
                                {{ $level->level_no }}
                            </td>

                            <td class="border p-2">
                                {{ $level->percentage }} %
                            </td>

                            <td class="border p-2">

                                <a href="{{ route('admin.level.settings.delete',$level->id) }}"
                                   onclick="return confirm('Delete Level?')"
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