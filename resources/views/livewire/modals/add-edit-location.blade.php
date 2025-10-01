<div class="grid grid-cols-1 md:grid-cols-1 gap-5 mb-5">
    <div>
        <label for="name">Name <span class="text-red-500">*</span></label>
        <input type="text" id="name" wire:model="name" class="mt-1 block w-full" required />
        @error('name')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="address">Address <span class="text-red-500">*</span></label>
        <input type="text" id="address" wire:model="address" class="mt-1 block w-full" required />
        @error('address')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="district">District <span class="text-red-500">*</span></label>
        <select id="district" wire:model="district_id" class="mt-1 block w-full" required>
            <option value="">Select District</option>
            @foreach ($districts as $district)
                <option value="{{ $district->id }}">{{ $district->name }}</option>
            @endforeach
        </select>
        @error('district_id')
            <span class="text-red-600 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <button wire:click="save" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md">Save</button>
    </div>
</div>
