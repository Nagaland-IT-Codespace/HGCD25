<div class="mx-auto p-6">
    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 flex items-center gap-2">
            <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5.121 17.804A9 9 0 1117.803 5.12M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Employee Assignment Overview
        </h1>
        <p class="text-sm text-gray-500">View detailed employee info and their assigned duties</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left Column: Employee Profile --}}
        <div class="lg:col-span-1">
            <div
                class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 text-center hover:shadow-md transition">
                @if ($emp && $emp->photo)
                    <img src="{{ asset('storage/' . $emp->photo) }}" alt="{{ $emp->full_name }}"
                        class="w-32 h-32 mx-auto rounded-full object-cover shadow-md mb-4 ring-4 ring-indigo-50">
                @else
                    <div
                        class="w-32 h-32 mx-auto rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-3xl mb-4 shadow-md">
                        {{ strtoupper(substr($emp->full_name ?? 'N/A', 0, 1)) }}
                    </div>
                @endif

                <h2 class="text-xl font-semibold text-gray-800">{{ $emp->full_name }}</h2>
                <p class="text-sm text-gray-500 mb-3">{{ $emp->designation ?? 'N/A' }}</p>

                <div class="text-sm text-gray-600 space-y-1 text-left mt-4">
                    <p><span class="font-medium text-gray-700">Emp Code:</span> {{ $emp->emp_code ?? '—' }}</p>
                    <p><span class="font-medium text-gray-700">District:</span> {{ $emp->district ?? '—' }}</p>
                    <p><span class="font-medium text-gray-700">Office:</span> {{ $emp->office_name ?? '—' }}</p>
                    <p><span class="font-medium text-gray-700">Mobile:</span> {{ $emp->mobile ?? '—' }}</p>
                    <p><span class="font-medium text-gray-700">Father’s Name:</span> {{ $emp->fathers_name ?? '—' }}</p>
                    <p><span class="font-medium text-gray-700">Gender:</span> {{ $emp->gender ?? '—' }}</p>
                    <p><span class="font-medium text-gray-700">Tribe:</span> {{ $emp->tribe_name ?? '—' }}</p>
                </div>
            </div>
        </div>

        {{-- Right Column: Assignments Table --}}
        <div class="lg:col-span-2">
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 hover:shadow-md transition">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                        Assignments
                    </h3>

                    <button
                        wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-assignment', 'params' : {'empID': {{ $emp->id }}}, 'size': '4', 'title': 'Add Assignment'}})"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-xl shadow">
                        + Add Assignment
                    </button>
                </div>

                @if ($assignments->isEmpty())
                    <div class="py-10 text-center text-gray-500">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <p>No assignments found for this employee.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left border-collapse">
                            <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
                                <tr>
                                    <th class="px-4 py-3">#</th>
                                    <th class="px-4 py-3">Date</th>
                                    <th class="px-4 py-3">Location</th>
                                    <th class="px-4 py-3">From</th>
                                    <th class="px-4 py-3">To</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($assignments as $index => $a)
                                    <tr class="hover:bg-indigo-50/40 transition">
                                        <td class="px-4 py-3 text-gray-500">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-4 py-3 font-medium text-gray-800">
                                            {{ \Carbon\Carbon::parse($a->date_of_assignment)->format('d M Y') }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-700">
                                            {{ $a->location?->name ?? '—' }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-700">{{ $a->from_time ?? '—' }}</td>
                                        <td class="px-4 py-3 text-gray-700">{{ $a->to_time ?? '—' }}</td>
                                        <td class="px-4 py-3">
                                            @php
                                                $color = match ($a->status) {
                                                    'Active' => 'bg-green-100 text-green-700',
                                                    'Completed' => 'bg-blue-100 text-blue-700',
                                                    'Pending' => 'bg-yellow-100 text-yellow-700',
                                                    default => 'bg-gray-100 text-gray-600',
                                                };
                                            @endphp
                                            <span
                                                class="px-3 py-1.5 text-xs font-semibold rounded-lg {{ $color }}">
                                                {{ $a->status ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="flex justify-center gap-2">
                                                <button
                                                    wire:click="$dispatch('showModal', {data: {'alias' : 'modals.edit-assignment', 'params' : {'assignmentID': {{ $a->id }}}, 'size': '4', 'title': 'Edit Location'}})"
                                                    class="px-3 py-1.5 bg-gray-50 text-gray-700 rounded-lg text-xs font-semibold hover:bg-gray-100">
                                                    Edit
                                                </button>
                                                <button wire:click="delete({{ $a->id }})"
                                                    class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg text-xs font-semibold hover:bg-red-100">
                                                    Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
