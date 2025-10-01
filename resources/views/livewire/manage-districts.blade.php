<div class="max-w-5xl mx-auto py-6 px-4">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-3">
        <div class="w-full sm:w-1/2">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search District..."
                class="w-full rounded-xl border-gray-200 bg-white px-4 py-2 text-sm shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none" />
        </div>
        <button
            wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-edit-district', 'size': '4', 'title': 'Add District'}})"
            class="bg-sky-600 hover:bg-sky-700 text-white text-sm font-medium px-5 py-2.5 rounded-xl shadow">
            + Add District
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
                    <th class="px-4 py-3 text-left">District Name</th>
                    <th class="px-4 py-3 text-center">Created</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($districts as $index => $district)
                    <tr class="hover:bg-indigo-50/30">
                        <td class="px-4 py-3 text-gray-500">
                            {{ ($districts->currentPage() - 1) * $districts->perPage() + $index + 1 }}
                        </td>
                        <td class="px-4 py-3 font-medium">{{ $district->name }}</td>
                        <td class="px-4 py-3 text-center text-gray-500">
                            {{ $district->created_at?->format('d M Y') }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                <button
                                    wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-edit-district', 'params' : {'districtID': {{ $district->id }}}, 'size': '4', 'title': 'Edit District'}})"
                                    class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg text-xs font-semibold hover:bg-red-100">
                                    Edit
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-6 text-center text-gray-500">No districts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4 border-t border-gray-100">
            {{ $districts->links() }}
        </div>
    </div>
</div>
