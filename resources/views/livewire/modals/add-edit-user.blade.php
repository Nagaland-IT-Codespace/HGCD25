<div class="grid grid-cols-1 gap-6 mb-5">
    {{-- loop over all errors below  --}}
    @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="p-4 border border-gray-200 rounded bg-sky-300/50">
        <div class="mb-3 text-sm text-gray-700">
            Note: A default password <span class="font-mono font-bold">default@123#</span> will be set for new users.
            Please ensure they change it upon first login.
        </div>
    </div>

    <div class="p-4 border border-gray-200 rounded">
        <label for="name">Full Name <span class="text-red-500">*</span></label>
        <input type="text" id="name" wire:model="name" class="mt-1 block w-full" required />
        @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="p-4 border border-gray-200 rounded">
        <label for="email">Email <span class="text-red-500">*</span></label>
        <input type="email" id="email" wire:model="email" class="mt-1 block w-full" required />
        @error('email')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="p-4 border border-gray-200 rounded">
        <label for="mobile">Mobile <span class="text-red-500">*</span></label>
        <input type="text" id="mobile" wire:model="mobile" class="mt-1 block w-full" minlength="10"
            maxlength="10" />
        @error('mobile')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="p-4 border border-gray-200 rounded">
        <label for="role">Role <span class="text-red-500">*</span></label>
        <select id="role" wire:model="role" class="mt-1 block w-full" required>
            <option value="">-- Select Role --</option>
            @foreach (App\Enums\RoleEnum::cases() as $role)
                <option value="{{ $role }}">{{ $role }}</option>
            @endforeach
        </select>
        @error('role')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex justify-end gap-3">
        <button wire:click="$emit('closeModal')" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
            Cancel
        </button>
        <button wire:click="save" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Save
        </button>
    </div>

</div>
