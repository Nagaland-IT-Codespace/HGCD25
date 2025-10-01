<div class="grid grid-cols-1 md:grid-cols-1 gap-5 mb-5">
    <div>
        <label for="name">District Name <span class="text-red-500">*</span></label>
        <input type="text" id="name" wire:model="name"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            required />
        @error('name')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <button wire:click="save" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md">Save</button>
    </div>
</div>
