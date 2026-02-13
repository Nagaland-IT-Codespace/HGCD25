<div class="mx-auto py-8 px-4 space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">District Directory</p>
            <h1 class="text-2xl font-semibold text-slate-900">Manage districts effortlessly</h1>
            <p class="text-sm text-slate-500">Search, add and update district records.</p>
        </div>
        <button
            wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-edit-district', 'size': '4', 'title': 'Add District'}})"
            class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white rounded-xl shadow-lg bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 hover:shadow-xl hover:translate-y-[-1px] transition">
            <span class="text-lg">＋</span>
            Add District
        </button>
    </div>

    <div class="bg-white/80 backdrop-blur border border-slate-100 shadow-lg rounded-2xl p-4 md:p-5 space-y-4">
        <div class="relative max-w-md">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search district..."
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm shadow-sm focus:ring-2 focus:ring-sky-500 focus:outline-none" />
            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs">⌘K</span>
        </div>

        @if (session()->has('success'))
            <div
                class="flex items-center gap-3 text-sm text-green-800 bg-green-50 border border-green-200 rounded-xl px-4 py-3">
                <span class="text-lg">✔</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="overflow-hidden border border-slate-100 rounded-xl shadow-sm">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-slate-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">District Name</th>
                        <th class="px-4 py-3 text-left">Created</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($districts as $index => $district)
                        <tr class="hover:bg-sky-50/60">
                            <td class="px-4 py-3 text-slate-500">
                                {{ ($districts->currentPage() - 1) * $districts->perPage() + $index + 1 }}
                            </td>
                            <td class="px-4 py-3 font-medium text-slate-900">{{ $district->name }}</td>
                            <td class="px-4 py-3 text-slate-600">
                                {{ $district->created_at?->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center gap-2">
                                    <button
                                        wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-edit-district', 'params' : {'districtID': {{ $district->id }}}, 'size': '4', 'title': 'Edit District'}})"
                                        class="px-3 py-1.5 bg-slate-900 text-white rounded-lg text-xs font-semibold hover:bg-slate-800">
                                        Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-slate-500">No districts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="p-4 border-t border-slate-100 bg-slate-50/60">
                {{ $districts->links() }}
            </div>
        </div>
    </div>
</div>
