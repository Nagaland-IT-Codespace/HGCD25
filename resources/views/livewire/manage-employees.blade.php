<div class="max-w-full mx-auto py-8 px-4 space-y-6">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Personnel</p>
            <h1 class="text-2xl font-semibold text-slate-900">Employee roster</h1>
            <p class="text-sm text-slate-500">Filter by district or gender and manage records quickly.</p>
        </div>
        <button
            wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-edit-employee', 'size': '4', 'title': 'Add Employee'}})"
            class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white rounded-xl shadow-lg bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 hover:shadow-xl hover:translate-y-[-1px] transition">
            <span class="text-lg">＋</span>
            Add Employee
        </button>
    </div>

    <div class="bg-white/80 backdrop-blur border border-slate-100 shadow-lg rounded-2xl p-4 md:p-5 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div class="relative">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by name"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm shadow-sm focus:ring-2 focus:ring-sky-500 focus:outline-none" />
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs">⌘K</span>
            </div>
            <div>
                <select wire:model.live.debounce.300ms="districtSearch"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm shadow-sm focus:ring-2 focus:ring-sky-500 focus:outline-none">
                    <option value="">All districts</option>
                    @foreach ($districts as $district)
                        <option value="{{ $district->name }}">{{ $district->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select wire:model.live.debounce.300ms="genderSearch"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm shadow-sm focus:ring-2 focus:ring-sky-500 focus:outline-none">
                    <option value="">All genders</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>
        </div>

        @if (session()->has('success'))
            <div
                class="flex items-center gap-3 text-sm text-green-800 bg-green-50 border border-green-200 rounded-xl px-4 py-3">
                <span class="text-lg">✔</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="overflow-x-auto border border-slate-100 rounded-xl shadow-sm">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-slate-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Avatar</th>
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
                <tbody class="divide-y divide-slate-100">
                    @forelse ($employees as $index => $employee)
                        <tr class="hover:bg-sky-50/60">
                            <td class="px-4 py-3 text-slate-500">
                                {{ ($employees->currentPage() - 1) * $employees->perPage() + $index + 1 }}
                            </td>
                            <td class="px-4 py-3 font-medium">
                                @if ($employee->photo)
                                    <img src="{{ Storage::URL($employee->photo) }}" alt="Avatar"
                                        class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <div
                                        class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-medium text-slate-900">{{ $employee->emp_code }}</td>
                            <td class="px-4 py-3 font-medium text-slate-900">{{ $employee->full_name }}</td>
                            <td class="px-4 py-3 font-medium text-slate-700">{{ $employee->mobile }}</td>
                            <td class="px-4 py-3 text-slate-600">
                                {{ Carbon\Carbon::parse($employee->dob)->format('d-m-Y') }}
                            </td>
                            <td class="px-4 py-3 text-slate-600">
                                {{ $employee->fathers_name }}
                            </td>
                            <td class="px-4 py-3">
                                @if ($employee->gender == 'F')
                                    <span
                                        class="px-3 py-1.5 bg-rose-50 text-rose-700 rounded-full text-xs font-semibold">Female</span>
                                @else
                                    <span
                                        class="px-3 py-1.5 bg-indigo-50 text-indigo-700 rounded-full text-xs font-semibold">Male</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-slate-600">
                                {{ $employee->designation }}
                            </td>
                            <td class="px-4 py-3 text-slate-600">
                                {{ $employee->district }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center gap-2">
                                    <button
                                        wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-edit-employee', 'params' : {'employeeID': {{ $employee->id }}}, 'size': '4', 'title': 'Edit Employee'}})"
                                        class="px-3 py-1.5 bg-slate-900 text-white rounded-lg text-xs font-semibold hover:bg-slate-800">
                                        Edit
                                    </button>
                                    <button wire:click="delete({{ $employee->id }})" wire:alert='"Are you sure?'
                                        class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-lg text-xs font-semibold hover:bg-slate-200">
                                        Delete
                                    </button>
                                    <a href="{{ route('viewIndividualAssignments', ['empID' => $employee->id]) }}"
                                        class="px-3 py-1.5 bg-emerald-50 text-emerald-700 rounded-lg text-xs font-semibold hover:bg-emerald-100">
                                        Assignments
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="py-8 text-center text-slate-500">No employees found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="p-4 border-t border-slate-100 bg-slate-50/60">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
</div>
