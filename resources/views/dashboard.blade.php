<x-dashboard-layout>
    <div class="space-y-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-6 gap-4">
            <div class="p-4 rounded-2xl bg-gradient-to-br from-sky-600 to-cyan-500 text-white shadow-lg">
                <p class="text-xs uppercase tracking-[0.2em] text-white/80">Employees</p>
                <div class="mt-2 flex items-end justify-between">
                    <span class="text-3xl font-bold">{{ $metrics['employees'] ?? 0 }}</span>
                    <span class="text-white/80 text-sm">Active roster</span>
                </div>
            </div>
            <div class="p-4 rounded-2xl bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white shadow-lg">
                <p class="text-xs uppercase tracking-[0.2em] text-white/70">Assignments</p>
                <div class="mt-2 flex items-end justify-between">
                    <span class="text-3xl font-bold">{{ $metrics['assignments'] ?? 0 }}</span>
                    <span class="text-white/70 text-sm">Total</span>
                </div>
            </div>
            <div class="p-4 rounded-2xl bg-white/80 backdrop-blur border border-slate-100 shadow-lg">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Districts</p>
                <div class="mt-2 flex items-end justify-between">
                    <span class="text-3xl font-bold text-slate-900">{{ $metrics['districts'] ?? 0 }}</span>
                    <span class="text-slate-500 text-sm">Coverage</span>
                </div>
            </div>
            <div class="p-4 rounded-2xl bg-white/80 backdrop-blur border border-slate-100 shadow-lg">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Locations</p>
                <div class="mt-2 flex items-end justify-between">
                    <span class="text-3xl font-bold text-slate-900">{{ $metrics['locations'] ?? 0 }}</span>
                    <span class="text-slate-500 text-sm">Sites</span>
                </div>
            </div>
            <div class="p-4 rounded-2xl bg-white/80 backdrop-blur border border-slate-100 shadow-lg">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Users</p>
                <div class="mt-2 flex items-end justify-between">
                    <span class="text-3xl font-bold text-slate-900">{{ $metrics['users'] ?? 0 }}</span>
                    <span class="text-slate-500 text-sm">Accounts</span>
                </div>
            </div>
            <div class="p-4 rounded-2xl bg-white/80 backdrop-blur border border-slate-100 shadow-lg">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Photo Verifications</p>
                <div class="mt-2 flex items-end justify-between">
                    <span class="text-3xl font-bold text-slate-900">{{ $metrics['photos'] ?? 0 }}</span>
                    <span class="text-slate-500 text-sm">Uploaded</span>
                </div>
            </div>
        </div>

        @php
            $totalAssignments = $metrics['assignments'] ?? 0;
            $statusTotals = [
                'Active' => $assignmentsByStatus['Active'] ?? 0,
                'Pending' => $assignmentsByStatus['Pending'] ?? 0,
                'Completed' => $assignmentsByStatus['Completed'] ?? 0,
            ];
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white/80 backdrop-blur border border-slate-100 rounded-2xl shadow-lg p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-slate-900">Assignment status</h3>
                    <span class="text-sm text-slate-500">{{ $totalAssignments }} total</span>
                </div>
                <div class="space-y-3">
                    @foreach ($statusTotals as $label => $value)
                        @php
                            $percent = $totalAssignments > 0 ? round(($value / $totalAssignments) * 100) : 0;
                            $bar = match ($label) {
                                'Active' => 'bg-emerald-500',
                                'Pending' => 'bg-amber-500',
                                'Completed' => 'bg-sky-600',
                                default => 'bg-slate-400',
                            };
                        @endphp
                        <div>
                            <div class="flex justify-between text-sm text-slate-600 mb-1">
                                <span>{{ $label }}</span>
                                <span>{{ $value }} ({{ $percent }}%)</span>
                            </div>
                            <div class="h-2 w-full rounded-full bg-slate-100 overflow-hidden">
                                <div class="h-full {{ $bar }} rounded-full transition-all" style="width: {{ $percent }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur border border-slate-100 rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Recent employees</h3>
                <div class="space-y-3">
                    @forelse ($recentEmployees as $employee)
                        <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">{{ $employee->full_name }}</p>
                                <p class="text-xs text-slate-500">{{ $employee->designation }}</p>
                            </div>
                            <span class="text-xs px-2.5 py-1 rounded-full bg-slate-200 text-slate-700">{{ $employee->district }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">No employees yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="bg-white/80 backdrop-blur border border-slate-100 rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-slate-900">Latest assignments</h3>
                <span class="text-sm text-slate-500">Last 5</span>
            </div>
            @if ($recentAssignments->isEmpty())
                <p class="text-sm text-slate-500">No assignments recorded.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left border-collapse">
                        <thead class="bg-slate-50 text-slate-600 uppercase text-xs font-semibold">
                            <tr>
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Employee</th>
                                <th class="px-4 py-3">Location</th>
                                <th class="px-4 py-3">From</th>
                                <th class="px-4 py-3">To</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($recentAssignments as $a)
                                @php
                                    $statusColor = match ($a->status) {
                                        'Active' => 'bg-emerald-50 text-emerald-700',
                                        'Completed' => 'bg-blue-50 text-blue-700',
                                        'Pending' => 'bg-amber-50 text-amber-700',
                                        default => 'bg-slate-100 text-slate-600',
                                    };
                                @endphp
                                <tr class="hover:bg-sky-50/60 transition">
                                    <td class="px-4 py-3 text-slate-700">
                                        {{ \Carbon\Carbon::parse($a->date_of_assignment)->format('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3 text-slate-900 font-medium">
                                        {{ $a->employee?->full_name ?? '—' }}
                                    </td>
                                    <td class="px-4 py-3 text-slate-700">
                                        {{ $a->location?->name ?? '—' }}
                                    </td>
                                    <td class="px-4 py-3 text-slate-700">{{ $a->from_time }}</td>
                                    <td class="px-4 py-3 text-slate-700">{{ $a->to_time }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-3 py-1.5 text-xs font-semibold rounded-lg {{ $statusColor }}">
                                            {{ $a->status ?? 'N/A' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-dashboard-layout>
