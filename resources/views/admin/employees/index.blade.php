<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Employee Management
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto">

            <div class="mb-4">
                <a href="{{ route('admin.employees.create') }}"
                   class="bg-green-600 text-white px-4 py-2 rounded">
                    + Add Employee
                </a>
            </div>

            <div class="bg-white shadow rounded">
                <table class="w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border">ID</th>
                            <th class="p-3 border">Name</th>
                            <th class="p-3 border">Email</th>
                            <th class="p-3 border">Role</th>
                            <th class="p-3 border">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($employees as $employee)
                        <tr>
                            <td class="p-3 border">{{ $employee->id }}</td>
                            <td class="p-3 border">{{ $employee->name }}</td>
                            <td class="p-3 border">{{ $employee->email }}</td>
                            <td class="p-3 border">{{ $employee->role }}</td>
                            <td class="p-3 border">{{ $employee->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>