<div class="mx-auto py-8 px-4 space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Employee overview</p>
            <h1 class="text-2xl font-semibold text-slate-900 flex items-center gap-2">
                <svg class="w-6 h-6 text-sky-500" fill="none" stroke="currentColor" stroke-width="1.6"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M5.121 17.804A9 9 0 1117.803 5.12M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Employee Assignment Overview
            </h1>
            <p class="text-sm text-slate-500">Profile card plus duties with quick actions.</p>
        </div>
        <button
            wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-assignment', 'params' : {'empID': {{ $emp->id }}}, 'size': '4', 'title': 'Add Assignment'}})"
            class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white rounded-xl shadow-lg bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 hover:shadow-xl hover:translate-y-[-1px] transition">
            <span class="text-lg">＋</span>
            Add Assignment
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Left Column: Employee Profile --}}
        <div class="lg:col-span-1">
            <div
                class="bg-white/80 backdrop-blur border border-slate-100 rounded-2xl shadow-lg p-6 text-center hover:shadow-xl transition">
                @if ($emp && $emp->photo)
                    <img src="{{ asset('storage/' . $emp->photo) }}" alt="{{ $emp->full_name }}"
                        class="w-32 h-32 mx-auto rounded-2xl object-cover shadow-md mb-4 ring-4 ring-sky-50">
                @else
                    <div
                        class="w-32 h-32 mx-auto rounded-2xl bg-sky-100 flex items-center justify-center text-sky-600 font-bold text-3xl mb-4 shadow-md">
                        {{ strtoupper(substr($emp->full_name ?? 'N/A', 0, 1)) }}
                    </div>
                @endif

                <h2 class="text-xl font-semibold text-slate-900">{{ $emp->full_name }}</h2>
                <p class="text-sm text-slate-500 mb-3">{{ $emp->designation ?? 'N/A' }}</p>

                <div class="text-sm text-slate-600 space-y-1 text-left mt-4">
                    <p><span class="font-medium text-slate-700">Emp Code:</span> {{ $emp->emp_code ?? '—' }}</p>
                    <p><span class="font-medium text-slate-700">District:</span> {{ $emp->district ?? '—' }}</p>
                    <p><span class="font-medium text-slate-700">Office:</span> {{ $emp->office_name ?? '—' }}</p>
                    <p><span class="font-medium text-slate-700">Mobile:</span> {{ $emp->mobile ?? '—' }}</p>
                    <p><span class="font-medium text-slate-700">Father’s Name:</span> {{ $emp->fathers_name ?? '—' }}
                    </p>
                    <p><span class="font-medium text-slate-700">Gender:</span> {{ $emp->gender ?? '—' }}</p>
                    <p><span class="font-medium text-slate-700">Tribe:</span> {{ $emp->tribe_name ?? '—' }}</p>
                </div>
            </div>
        </div>

        {{-- Right Column: Assignments Table --}}
        <div class="lg:col-span-2">
            <div
                class="bg-white/80 backdrop-blur border border-slate-100 rounded-2xl shadow-lg p-6 hover:shadow-xl transition">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
                    <h3 class="text-lg font-semibold text-slate-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-sky-500" fill="none" stroke="currentColor" stroke-width="1.6"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                        Assignments
                    </h3>

                    <button
                        wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-assignment', 'params' : {'empID': {{ $emp->id }}}, 'size': '4', 'title': 'Add Assignment'}})"
                        class="hidden sm:inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white rounded-xl shadow-md bg-slate-900 hover:bg-slate-800 transition">
                        Add Assignment
                    </button>
                </div>

                @if ($assignments->isEmpty())
                    <div class="py-10 text-center text-slate-500">
                        <svg class="w-12 h-12 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor"
                            stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <p>No assignments found for this employee.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left border-collapse">
                            <thead class="bg-slate-50 text-slate-600 uppercase text-xs font-semibold">
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
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($assignments as $index => $a)
                                    <tr class="hover:bg-sky-50/60 transition">
                                        <td class="px-4 py-3 text-slate-500">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-4 py-3 font-medium text-slate-900">
                                            {{ \Carbon\Carbon::parse($a->date_of_assignment)->format('d M Y') }}
                                        </td>
                                        <td class="px-4 py-3 text-slate-700">
                                            {{ $a->location?->name ?? '—' }}
                                        </td>
                                        <td class="px-4 py-3 text-slate-700">{{ $a->from_time ?? '—' }}</td>
                                        <td class="px-4 py-3 text-slate-700">{{ $a->to_time ?? '—' }}</td>
                                        <td class="px-4 py-3">
                                            @php
                                                $color = match ($a->status) {
                                                    'Active' => 'bg-emerald-50 text-emerald-700',
                                                    'Completed' => 'bg-blue-50 text-blue-700',
                                                    'Pending' => 'bg-amber-50 text-amber-700',
                                                    default => 'bg-slate-100 text-slate-600',
                                                };
                                            @endphp
                                            <span
                                                class="px-3 py-1.5 text-xs font-semibold rounded-lg {{ $color }}">
                                                {{ $a->status ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <div class="flex justify-center gap-2">
                                                @if ($a->photoVerifications->count() > 0)
                                                    <button
                                                        wire:click="$dispatch('showModal', {data: {'alias' : 'modals.view-photos', 'params' : {'assignmentID': {{ $a->id }}}, 'size': '5', 'title': 'Verification Photos'}})"
                                                        class="relative px-3 py-1.5 bg-sky-50 text-sky-700 rounded-lg text-xs font-semibold hover:bg-sky-100 flex items-center gap-1">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        Photos
                                                        <span
                                                            class="absolute -top-2 -right-2 flex h-4 w-4 items-center justify-center rounded-full bg-sky-500 text-[10px] text-white shadow-sm">
                                                            {{ $a->photoVerifications->count() }}
                                                        </span>
                                                    </button>
                                                @endif
                                                <button
                                                    wire:click="$dispatch('showModal', {data: {'alias' : 'modals.edit-assignment', 'params' : {'assignmentID': {{ $a->id }}}, 'size': '4', 'title': 'Edit Assignment'}})"
                                                    class="px-3 py-1.5 bg-slate-900 text-white rounded-lg text-xs font-semibold hover:bg-slate-800">
                                                    Edit
                                                </button>
                                                <button wire:click="delete({{ $a->id }})"
                                                    class="px-3 py-1.5 bg-rose-50 text-rose-700 rounded-lg text-xs font-semibold hover:bg-rose-100">
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
