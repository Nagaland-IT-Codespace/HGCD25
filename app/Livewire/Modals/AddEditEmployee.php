<?php

namespace App\Livewire\Modals;

use App\Models\DistrictMaster;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AddEditEmployee extends Component
{
    use WithFileUploads;
    public $employeeID;
    public $emp_code;
    public $full_name;
    public $mobile;
    public $dob;
    public $fathers_name;
    public $gender;
    public $office_name;
    public $district;
    public $designation;
    public $tribe_name;
    public $photo;
    public $uploadedPhoto;

    public function mount($employeeID = null)
    {
        $this->employeeID = $employeeID;
        $emp = Employee::find($this->employeeID);
        if ($emp) {
            $this->emp_code = $emp->emp_code;
            $this->full_name = $emp->full_name;
            $this->mobile = $emp->mobile;
            $this->dob = $emp->dob;
            $this->fathers_name = $emp->fathers_name;
            $this->gender = $emp->gender;
            $this->office_name = $emp->office_name;
            $this->district = $emp->district;
            $this->designation = $emp->designation;
            $this->tribe_name = $emp->tribe_name;
            $this->photo = $emp->photo;
        }
    }

    public function save()
    {
        $this->validate([
            'emp_code' => 'required',
            'full_name' => 'required',
            'mobile' => 'nullable|digits:10',
            'dob' => 'required|date',
            'fathers_name' => 'required|string|max:255',
            'gender' => 'required|in:M,F',
            'office_name' => 'required',
            'district' => 'required',
            'designation' => 'required',
            'tribe_name' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:1024', // 1MB Max
        ]);

        try {
            DB::beginTransaction();
            Employee::updateOrCreate(
                ['id' => $this->employeeID],
                [
                    'emp_code' => $this->emp_code,
                    'full_name' => $this->full_name,
                    'mobile' => $this->mobile,
                    'dob' => $this->dob,
                    'fathers_name' => $this->fathers_name,
                    'gender' => $this->gender,
                    'office_name' => $this->office_name,
                    'district' => $this->district,
                    'designation' => $this->designation,
                    'tribe_name' => $this->tribe_name,
                    'photo' => $this->uploadedPhoto ? $this->uploadedPhoto->store('photos', 'public') : null,
                ]
            );
            DB::commit();
            $this->dispatch('swal', ['type' => 'success', 'message' => 'Employee saved successfully!']);
            $this->dispatch('hideTailwindModal');
            $this->dispatch('operationCompleted');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('swal', ['type' => 'error', 'message' => 'An error occurred: ' . $e->getMessage()]);
            $this->dispatch('hideTailwindModal');
        }
    }

    public function render()
    {
        $districts = DistrictMaster::orderBy('name', 'ASC')->get();
        return view('livewire.modals.add-edit-employee', compact('districts'));
    }
}
