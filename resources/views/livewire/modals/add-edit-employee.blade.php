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

    @if ($photo)
        <div class="p-4 border border-slate-200 rounded-xl bg-slate-50">
            <img src="{{ Storage::URL($photo) }}" alt="Employee Photo" class="w-24 h-24 rounded-xl object-cover" />
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <label class="space-y-1">
            <span class="text-sm font-medium text-slate-700">Employee Code <span class="text-red-500">*</span></span>
            <input type="text" id="emp_code" wire:model="emp_code"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none"
                required />
            @error('emp_code')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </label>

        <label class="space-y-1">
            <span class="text-sm font-medium text-slate-700">Full Name <span class="text-red-500">*</span></span>
            <input type="text" id="full_name" wire:model="full_name"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none"
                required />
            @error('full_name')
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
            <span class="text-sm font-medium text-slate-700">Date of Birth <span class="text-red-500">*</span></span>
            <input type="date" id="dob" wire:model="dob"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none"
                required />
            @error('dob')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </label>

        <label class="space-y-1">
            <span class="text-sm font-medium text-slate-700">Father's Name <span class="text-red-500">*</span></span>
            <input type="text" id="fathers_name" wire:model="fathers_name"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none"
                required />
            @error('fathers_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </label>

        <label class="space-y-1">
            <span class="text-sm font-medium text-slate-700">Gender <span class="text-red-500">*</span></span>
            <select id="gender" wire:model="gender"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none"
                required>
                <option value="">-- Select Gender --</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
            @error('gender')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </label>

        <label class="space-y-1">
            <span class="text-sm font-medium text-slate-700">Designation <span class="text-red-500">*</span></span>
            <input type="text" id="designation" wire:model="designation"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none"
                required />
            @error('designation')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </label>

        <label class="space-y-1">
            <span class="text-sm font-medium text-slate-700">Office <span class="text-red-500">*</span></span>
            <input type="text" id="office_name" wire:model="office_name"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none"
                required />
            @error('office_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </label>

        <label class="space-y-1">
            <span class="text-sm font-medium text-slate-700">District <span class="text-red-500">*</span></span>
            <select id="district" wire:model="district"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none"
                required>
                <option value="">-- Select District --</option>
                @foreach ($districts as $district)
                    <option value="{{ $district->name }}">{{ $district->name }}</option>
                @endforeach
            </select>
            @error('district')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </label>

        <label class="space-y-1">
            <span class="text-sm font-medium text-slate-700">Tribe <span class="text-red-500">*</span></span>
            <select id="tribe_name" wire:model="tribe_name"
                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none"
                required>
                <option value="">-- Select Tribe --</option>
                <option value="ANGAMI">ANGAMI</option>
                <option value="AO">AO</option>
                <option value="CHAKHESANG">CHAKHESANG</option>
                <option value="CHANG">CHANG</option>
                <option value="KACHARI">KACHARI</option>
                <option value="KUKI">KUKI</option>
                <option value="GARO">GARO</option>
                <option value="KONYAK">KONYAK</option>
                <option value="LOTHA">LOTHA</option>
                <option value="POCHURY">POCHURY</option>
                <option value="RENGMA">RENGMA</option>
                <option value="SANGTAM">SANGTAM</option>
                <option value="SUMI">SUMI</option>
                <option value="YIMCHUNGER">YIMCHUNGER</option>
                <option value="ZELIANG">ZELIANG</option>
                <option value="OTHER">OTHER</option>
            </select>
            @error('tribe_name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </label>
    </div>

    <label class="space-y-1 block">
        <span class="text-sm font-medium text-slate-700">Photograph <span class="text-red-500">*</span></span>
        <input type="file" id="uploadedPhoto" wire:model="uploadedPhoto"
            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm focus:ring-2 focus:ring-sky-500 focus:outline-none"
            required />
        @error('uploadedPhoto')
            <span class="text-red-500 text-sm">{{ $message }}</span>
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
