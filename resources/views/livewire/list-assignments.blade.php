<div class="space-y-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Manage Assignments</h2>
            <p class="text-sm text-slate-500">Search, filter and browse all assignment records.</p>
        </div>

        <div class="flex flex-col sm:flex-row gap-2">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search employee or location"
                class="w-full sm:w-72 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-cyan-500 focus:ring-cyan-200 focus:outline-none" />

            <input type="date" wire:model.live="date_filter"
                class="w-full sm:w-44 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-cyan-500 focus:ring-cyan-200 focus:outline-none" />

            <button wire:click="$set('date_filter', null)"
                class="px-4 py-2 text-sm font-semibold text-white bg-gray-500 rounded-lg hover:bg-gray-600">Clear</button>
        </div>
    </div>

    <div class="overflow-x-auto bg-white border border-gray-200 rounded-lg shadow-sm">
        <table class="min-w-full text-left">
            <thead class="bg-slate-50 text-sm text-slate-700">
                <tr>
                    <th class="px-4 py-3 font-semibold">ID</th>
                    <th class="px-4 py-3 font-semibold">Employee</th>
                    <th class="px-4 py-3 font-semibold">Location</th>
                    <th class="px-4 py-3 font-semibold">Date</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 font-semibold">Is Viewed</th>
                    <th class="px-4 py-3 font-semibold">Created</th>
                    <th class="px-4 py-3 font-semibold">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($assignments as $assignment)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-4 py-3 text-sm text-slate-600">{{ $assignment->id }}</td>
                        <td class="px-4 py-3 text-sm text-slate-700">
                            {{ optional($assignment->employee)->full_name ?? 'N/A' }}
                            <div class="text-xs text-slate-500">{{ optional($assignment->employee)->emp_code ?? '' }}
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-700">
                            {{ optional($assignment->location)->name ?? 'N/A' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-700">
                            {{ $assignment->date_of_assignment
                                ? \Carbon\Carbon::parse($assignment->date_of_assignment)->format('M d, Y')
                                : 'N/A' }}
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $badge = 'bg-gray-100 text-gray-700';
                                if ($assignment->status === 'active') {
                                    $badge = 'bg-emerald-100 text-emerald-700';
                                }
                                if ($assignment->status === 'pending') {
                                    $badge = 'bg-amber-100 text-amber-700';
                                }
                                if ($assignment->status === 'completed') {
                                    $badge = 'bg-blue-100 text-blue-700';
                                }
                                if ($assignment->status === 'cancelled') {
                                    $badge = 'bg-red-100 text-red-700';
                                }
                            @endphp
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full {{ $badge }} ">{{ ucfirst($assignment->status ?? 'unknown') }}</span>
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $viewedBadge = $assignment->is_viewed ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700';
                            @endphp
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $viewedBadge }}">
                                {{ $assignment->is_viewed ? 'Viewed' : 'Not Viewed' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-500">
                            {{ $assignment->created_at ? $assignment->created_at->format('M d, Y') : '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('viewIndividualAssignments', ['empID' => optional($assignment->employee)->id ?? '#']) }}"
                                class="px-3 py-1 text-white bg-cyan-500 rounded hover:bg-cyan-600">Details</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-sm text-slate-500">No assignments found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $assignments->links() }}
    </div>
</div>
