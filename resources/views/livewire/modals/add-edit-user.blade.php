<div class="space-y-4">
    @if ($errors->any())
        <div class="flex items-start gap-3 text-sm text-rose-800 bg-rose-50 border border-rose-200 rounded-xl px-4 py-3">
            <span class="text-lg">⚠</span>
            <ul class="space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="p-4 border border-slate-200 rounded-xl bg-sky-50">
        <div class="text-sm text-slate-700">
            Note: A default password <span class="font-mono font-bold">default@123#</span> will be set for new users.
            Please ensure they change it upon first login.
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4">
        <label class="space-y-1">
            <span class="text-sm font-medium text-slate-700">Full Name <span class="text-red-500">*</span></span>
            <input type="text" id="name" wire:model="name"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none" required />
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </label>

        <label class="space-y-1">
            <span class="text-sm font-medium text-slate-700">Email <span class="text-red-500">*</span></span>
            <input type="email" id="email" wire:model="email"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none" required />
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </label>

        <label class="space-y-1">
            <span class="text-sm font-medium text-slate-700">Mobile <span class="text-red-500">*</span></span>
            <input type="text" id="mobile" wire:model="mobile"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none"
                minlength="10" maxlength="10" />
            @error('mobile')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </label>

        <label class="space-y-1">
            <span class="text-sm font-medium text-slate-700">Role <span class="text-red-500">*</span></span>
            <select id="role" wire:model="role"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none"
                required>
                <option value="">-- Select Role --</option>
                @foreach (App\Enums\RoleEnum::cases() as $role)
                    <option value="{{ $role }}">{{ $role }}</option>
                @endforeach
            </select>
            @error('role')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </label>
    </div>

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
