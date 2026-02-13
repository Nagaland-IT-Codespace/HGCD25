<div class="mx-auto py-8 px-4 space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">Locations</p>
            <h1 class="text-2xl font-semibold text-slate-900">Coordinate operational sites</h1>
            <p class="text-sm text-slate-500">Filter by district and keep addresses up to date.</p>
        </div>
        <button
            wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-edit-location', 'size': '4', 'title': 'Add Location'}})"
            class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white rounded-xl shadow-lg bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 hover:shadow-xl hover:translate-y-[-1px] transition">
            <span class="text-lg">＋</span>
            Add Location
        </button>
    </div>

    <div class="bg-white/80 backdrop-blur border border-slate-100 shadow-lg rounded-2xl p-4 md:p-5 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div class="relative">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search location name"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm shadow-sm focus:ring-2 focus:ring-sky-500 focus:outline-none" />
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs">⌘K</span>
            </div>
            <div>
                <select wire:model.live.debounce.300ms="districtSearch"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm shadow-sm focus:ring-2 focus:ring-sky-500 focus:outline-none">
                    <option value="">All districts</option>
                    @foreach ($districts as $district)
                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                    @endforeach
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

        <div class="overflow-hidden border border-slate-100 rounded-xl shadow-sm">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-slate-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Location Name</th>
                        <th class="px-4 py-3 text-left">Address</th>
                        <th class="px-4 py-3 text-left">District</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($locations as $index => $location)
                        <tr class="hover:bg-sky-50/60">
                            <td class="px-4 py-3 text-slate-500">
                                {{ ($locations->currentPage() - 1) * $locations->perPage() + $index + 1 }}
                            </td>
                            <td class="px-4 py-3 font-medium text-slate-900">{{ $location->name }}</td>
                            <td class="px-4 py-3 text-slate-700">{{ $location->address }}</td>
                            <td class="px-4 py-3 text-slate-600">
                                {{ $location->district->name }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center gap-2">
                                    <button
                                        wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-edit-location', 'params' : {'locationID': {{ $location->id }}}, 'size': '4', 'title': 'Edit Location'}})"
                                        class="px-3 py-1.5 bg-slate-900 text-white rounded-lg text-xs font-semibold hover:bg-slate-800">
                                        Edit
                                    </button>
                                    <button wire:click="delete({{ $location->id }})"
                                        class="px-3 py-1.5 bg-slate-100 text-slate-700 rounded-lg text-xs font-semibold hover:bg-slate-200">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-500">No locations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="p-4 border-t border-slate-100 bg-slate-50/60">
                {{ $locations->links() }}
            </div>
        </div>
    </div>
</div>
