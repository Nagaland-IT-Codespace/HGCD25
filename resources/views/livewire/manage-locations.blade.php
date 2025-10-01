<div class="max-w-5xl mx-auto py-6 px-4">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-3">
        <div class="w-full sm:w-1/2">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search Location Name..."
                class="w-full rounded-xl border-gray-200 bg-white px-4 py-2 text-sm shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none" />
        </div>
        <div class="w-full sm:w-1/2">
            <select wire:model.live.debounce.300ms="districtSearch"
                class="w-full rounded-xl border-gray-200 bg-white px-4 py-2 text-sm shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                <option value="">Select District</option>
                @foreach ($districts as $district)
                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                @endforeach
            </select>
        </div>
        <button
            wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-edit-location', 'size': '4', 'title': 'Add Location'}})"
            class="bg-sky-600 hover:bg-sky-700 text-white text-sm font-medium px-5 py-2.5 rounded-xl shadow">
            + Add Location
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
                    <th class="px-4 py-3 text-left">Location Name</th>
                    <th class="px-4 py-3 text-left">Address</th>
                    <th class="px-4 py-3 text-left">District</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($locations as $index => $location)
                    <tr class="hover:bg-indigo-50/30">
                        <td class="px-4 py-3 text-gray-500">
                            {{ ($locations->currentPage() - 1) * $locations->perPage() + $index + 1 }}
                        </td>
                        <td class="px-4 py-3 font-medium">{{ $location->name }}</td>
                        <td class="px-4 py-3 font-medium">{{ $location->address }}</td>
                        <td class="px-4 py-3 text-center text-gray-500">
                            {{ $location->district->name }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                <button
                                    wire:click="$dispatch('showModal', {data: {'alias' : 'modals.add-edit-location', 'params' : {'locationID': {{ $location->id }}}, 'size': '4', 'title': 'Edit Location'}})"
                                    class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg text-xs font-semibold hover:bg-red-100">
                                    Edit
                                </button>
                                <button wire:click="delete({{ $location->id }})"
                                    class="px-3 py-1.5 bg-gray-50 text-gray-700 rounded-lg text-xs font-semibold hover:bg-gray-100">
                                    Delete
                                </button>
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
            {{ $locations->links() }}
        </div>
    </div>
</div>
