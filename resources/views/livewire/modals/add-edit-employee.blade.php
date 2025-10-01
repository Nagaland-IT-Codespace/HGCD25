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

    @if ($photo)
        <div class="p-4 border border-gray-200 rounded">
            <img src="{{ Storage::URL($photo) }}" alt="Employee Photo" width="120" height="80" />
        </div>
    @endif
    <div class="p-4 border border-gray-200 rounded">
        <label for="emp_code">Employee Code <span class="text-red-500">*</span></label>
        <input type="text" id="emp_code" wire:model="emp_code" class="mt-1 block w-full" required />
        @error('emp_code')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="p-4 border border-gray-200 rounded">
        <label for="full_name">Full Name <span class="text-red-500">*</span></label>
        <input type="text" id="full_name" wire:model="full_name" class="mt-1 block w-full" required />
        @error('full_name')
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
        <label for="dob">Date of Birth <span class="text-red-500">*</span></label>
        <input type="date" id="dob" wire:model="dob" class="mt-1 block w-full" required />
        @error('dob')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="p-4 border border-gray-200 rounded">
        <label for="fathers_name">Father's Name <span class="text-red-500">*</span></label>
        <input type="text" id="fathers_name" wire:model="fathers_name" class="mt-1 block w-full" required />
        @error('fathers_name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="p-4 border border-gray-200 rounded">
        <label for="gender">Gender <span class="text-red-500">*</span></label>
        <select id="gender" wire:model="gender" class="mt-1 block w-full" required>
            <option value="">-- Select Gender --</option>
            <option value="M">Male</option>
            <option value="F">Female</option>
        </select>
        @error('gender')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="p-4 border border-gray-200 rounded">
        <label for="designation">Designation <span class="text-red-500">*</span></label>
        <input type="text" id="designation" wire:model="designation" class="mt-1 block w-full" required />
        @error('designation')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="p-4 border border-gray-200 rounded">
        <label for="office_name">Office <span class="text-red-500">*</span></label>
        <input type="text" id="office_name" wire:model="office_name" class="mt-1 block w-full" required />
        @error('office_name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="p-4 border border-gray-200 rounded">
        <label for="district">District <span class="text-red-500">*</span></label>
        <select id="district" wire:model="district" class="mt-1 block w-full" required>
            <option value="">-- Select District --</option>
            @foreach ($districts as $district)
                <option value="{{ $district->name }}">{{ $district->name }}</option>
            @endforeach
        </select>
        @error('district')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>
    <div class="p-4 border border-gray-200 rounded">
        <label for="tribe_name">Tribe <span class="text-red-500">*</span></label>
        <select id="tribe_name" wire:model="tribe_name" class="mt-1 block w-full" required>
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
    </div>

    <div class="p-4 border border-gray-200 rounded">
        <label for="uploadedPhoto">Photograph <span class="text-red-500">*</span></label>
        <input type="file" id="uploadedPhoto" wire:model="uploadedPhoto" class="mt-1 block w-full" required />
        @error('uploadedPhoto')
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
