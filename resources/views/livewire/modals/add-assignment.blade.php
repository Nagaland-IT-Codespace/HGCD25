<div class="p-6 space-y-5">
    {{-- Heading --}}
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-lg font-semibold text-gray-800">
            Add New Assignment
        </h2>
    </div>

    {{-- Employee --}}
    <div class="flex flex-col">
        <label for="employee_id" class="text-sm font-medium text-gray-700 mb-1">Employee <span
                class="text-red-500">*</span></label>
        <select wire:model="employee_id" id="employee_id"
            class="w-full rounded-xl border-gray-200 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300"
            disabled>
            <option value="">Employee...</option>
            @foreach ($employees as $e)
                <option value="{{ $e->id }}">{{ $e->emp_code }} - {{ $e->full_name }}</option>
            @endforeach
        </select>
        @error('employee_id')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Location --}}
    <div class="flex flex-col">
        <label for="location_id" class="text-sm font-medium text-gray-700 mb-1">Location <span
                class="text-red-500">*</span></label>
        <select wire:model="location_id" id="location_id"
            class="tom-select w-full rounded-xl border-gray-200 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300">
            <option value="">Search or select a location...</option>
            @foreach ($locations as $loc)
                <option value="{{ $loc->id }}">{{ $loc->name }}</option>
            @endforeach
        </select>
        @error('location_id')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Date of Assignment --}}
    <div class="flex flex-col sm:flex-row sm:gap-4">
        <div class="w-full sm:w-1/2">
            <label for="date_of_assignment" class="text-sm font-medium text-gray-700 mb-1">Date of Assignment <span
                    class="text-red-500">*</span></label>
            <input wire:model="date_of_assignment" id="date_of_assignment" type="date"
                class="w-full rounded-xl border-gray-200 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300" />
            @error('date_of_assignment')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Time Range (24-hour) --}}
    <div class="flex flex-col sm:flex-row sm:gap-4">
        <div class="w-full sm:w-1/2">
            <label for="from_time" class="text-sm font-medium text-gray-700 mb-1">From Time (24h) <span
                    class="text-red-500">*</span></label>
            <input wire:model="from_time" id="from_time" type="time" step="60"
                class="w-full rounded-xl border-gray-200 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300" />
            @error('from_time')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="w-full sm:w-1/2">
            <label for="to_time" class="text-sm font-medium text-gray-700 mb-1">To Time (24h) <span
                    class="text-red-500">*</span></label>
            <input wire:model="to_time" id="to_time" type="time" step="60"
                class="w-full rounded-xl border-gray-200 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300" />
            @error('to_time')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Status --}}
    <div class="flex flex-col">
        <label for="status" class="text-sm font-medium text-gray-700 mb-1">Status <span
                class="text-red-500">*</span></label>
        <select wire:model="status" id="status"
            class="w-full rounded-xl border-gray-200 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300">
            <option value="">Select status...</option>
            <option value="Active">Active</option>
            <option value="Completed">Completed</option>
            <option value="Pending">Pending</option>
        </select>
        @error('status')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Footer --}}
    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
        <button wire:click="$dispatch('hideTailwindModal')" type="button"
            class="px-4 py-2 text-sm font-medium bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-700">
            Cancel
        </button>

        <button wire:click="save"
            class="px-4 py-2 text-sm font-medium bg-indigo-600 hover:bg-indigo-700 rounded-lg text-white shadow-sm">
            Save Assignment
        </button>
    </div>
</div>
