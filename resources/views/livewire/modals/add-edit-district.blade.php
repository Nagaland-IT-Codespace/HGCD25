<div class="space-y-4">
    <label class="space-y-1">
        <span class="text-sm font-medium text-slate-700">District Name <span class="text-red-500">*</span></span>
        <input type="text" id="name" wire:model="name"
            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none"
            required />
        @error('name')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </label>

    <div class="flex justify-end gap-3 pt-2">
        <button wire:click="$emit('closeModal')"
            class="px-4 py-2 text-sm font-semibold text-slate-700 bg-slate-100 rounded-xl hover:bg-slate-200">
            Cancel
        </button>
        <button wire:click="save"
            class="px-4 py-2 text-sm font-semibold text-white rounded-xl bg-slate-900 hover:bg-slate-800">
            Save
        </button>
    </div>
</div>
