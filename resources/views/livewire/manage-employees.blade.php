<div class="mx-auto py-6 px-4">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-3">
        <div class="w-full sm:w-1/2">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by Name..."
                class="w-full rounded-xl border-gray-200 bg-white px-4 py-2 text-sm shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none" />
        </div>
        <div class="w-full sm:w-1/2">
            <select wire:model.live.debounce.300ms="districtSearch"
                class="w-full rounded-xl border-gray-200 bg-white px-4 py-2 text-sm shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                <option value="">Select District</option>
                @foreach ($districts as $district)
                    <option value="{{ $district->name }}">{{ $district->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full sm:w-1/2">
            <select wire:model.live.debounce.300ms="genderSearch"
                class="w-full rounded-xl border-gray-200 bg-white px-4 py-2 text-sm shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                <option value="">Select Gender</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
        </div>
        <button
            wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-edit-employee', 'size': '4', 'title': 'Add Employee'}})"
            class="bg-sky-600 hover:bg-sky-700 text-white text-sm font-medium px-5 py-2.5 rounded-xl shadow">
            + Add Employee
        </button>
    </div>

    @if (session()->has('success'))
        <div class="mb-3 text-sm text-green-700 bg-green-100 border border-green-200 rounded-lg px-3 py-2">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">#Avatar</th>
                    <th class="px-4 py-3 text-left">Emp Code</th>
                    <th class="px-4 py-3 text-left">Full Name</th>
                    <th class="px-4 py-3 text-left">Mobile</th>
                    <th class="px-4 py-3 text-left">DoB</th>
                    <th class="px-4 py-3 text-left">Father's Name</th>
                    <th class="px-4 py-3 text-left">Gender</th>
                    <th class="px-4 py-3 text-left">Designation</th>
                    <th class="px-4 py-3 text-left">District</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($employees as $index => $employee)
                    <tr class="hover:bg-indigo-50/30">
                        <td class="px-4 py-3 text-gray-500">
                            {{ ($employees->currentPage() - 1) * $employees->perPage() + $index + 1 }}
                        </td>
                        <td class="px-4 py-3 font-medium">
                            @if ($employee->photo)
                                <img src="{{ Storage::URL($employee->photo) }}" alt="Avatar"
                                    class="w-10 h-10 rounded-full object-cover">
                            @else
                                <div
                                    class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium">{{ $employee->emp_code }}</td>
                        <td class="px-4 py-3 font-medium">{{ $employee->full_name }}</td>
                        <td class="px-4 py-3 font-medium">{{ $employee->mobile }}</td>
                        <td class="px-4 py-3 text-center text-gray-500">
                            {{ Carbon\Carbon::parse($employee->dob)->format('d-m-Y') }}
                        </td>
                        <td class="px-4 py-3 text-center text-gray-500">
                            {{ $employee->fathers_name }}
                        </td>
                        <td class="px-4 py-3 text-center text-gray-500">
                            @if ($employee->gender == 'F')
                                <span
                                    class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg text-xs font-semibold hover:bg-red-100">Female</span>
                            @else
                                <span
                                    class="px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg text-xs font-semibold hover:bg-blue-100">Male</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center text-gray-500">
                            {{ $employee->designation }}
                        </td>
                        <td class="px-4 py-3 text-center text-gray-500">
                            {{ $employee->district }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                <button
                                    wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-edit-employee', 'params' : {'employeeID': {{ $employee->id }}}, 'size': '4', 'title': 'Edit Employee'}})"
                                    class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg text-xs font-semibold hover:bg-red-100">
                                    Edit
                                </button>
                                <button wire:click="delete({{ $employee->id }})"
                                    class="px-3 py-1.5 bg-gray-50 text-gray-700 rounded-lg text-xs font-semibold hover:bg-gray-100">
                                    Delete
                                </button>
                                <a href="{{ route('viewIndividualAssignments', ['empID' => $employee->id]) }}"
                                    class="px-3 py-1.5 bg-green-50 text-green-700 rounded-lg text-xs font-semibold hover:bg-green-100">
                                    Assignments
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-500">No Locations found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4 border-t border-gray-100">
            {{ $employees->links() }}
        </div>
    </div>
</div>
