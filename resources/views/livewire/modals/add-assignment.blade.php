<div class="p-6 space-y-5">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-lg font-semibold text-slate-900">Add New Assignment</h2>
    </div>

    <div class="space-y-3">
        <label class="space-y-1 block">
            <span class="text-sm font-medium text-slate-700">Employee <span class="text-red-500">*</span></span>
            <select wire:model="employee_id" id="employee_id"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm shadow-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500"
                disabled>
                <option value="">Employee...</option>
                @foreach ($employees as $e)
                    <option value="{{ $e->id }}">{{ $e->emp_code }} - {{ $e->full_name }}</option>
                @endforeach
            </select>
            @error('employee_id')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </label>

        <label class="space-y-1 block">
            <span class="text-sm font-medium text-slate-700">Location <span class="text-red-500">*</span></span>
            <select wire:model="location_id" id="location_id"
                class="tom-select w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm shadow-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                <option value="">Search or select a location...</option>
                @foreach ($locations as $loc)
                    <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                @endforeach
            </select>
            @error('location_id')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </label>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <label class="space-y-1 block">
                <span class="text-sm font-medium text-slate-700">Date of Assignment <span class="text-red-500">*</span></span>
                <input wire:model="date_of_assignment" id="date_of_assignment" type="date"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm shadow-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500" />
                @error('date_of_assignment')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </label>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <label class="space-y-1 block">
                <span class="text-sm font-medium text-slate-700">From Time (24h) <span class="text-red-500">*</span></span>
                <input wire:model="from_time" id="from_time" type="time" step="60"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm shadow-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500" />
                @error('from_time')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </label>

            <label class="space-y-1 block">
                <span class="text-sm font-medium text-slate-700">To Time (24h) <span class="text-red-500">*</span></span>
                <input wire:model="to_time" id="to_time" type="time" step="60"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm shadow-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500" />
                @error('to_time')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </label>
        </div>

        <label class="space-y-1 block">
            <span class="text-sm font-medium text-slate-700">Status <span class="text-red-500">*</span></span>
            <select wire:model="status" id="status"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm shadow-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                <option value="">Select status...</option>
                <option value="Active">Active</option>
                <option value="Completed">Completed</option>
                <option value="Pending">Pending</option>
            </select>
            @error('status')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </label>
    </div>

    <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
        <button wire:click="$dispatch('hideTailwindModal')" type="button"
            class="px-4 py-2 text-sm font-semibold text-slate-700 bg-slate-100 rounded-xl hover:bg-slate-200">
            Cancel
        </button>

        <button wire:click="save"
            class="px-4 py-2 text-sm font-semibold text-white rounded-xl bg-slate-900 hover:bg-slate-800 shadow-sm">
            Save Assignment
        </button>
    </div>
</div>
