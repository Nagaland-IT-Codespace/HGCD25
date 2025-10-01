<?php

namespace App\Livewire\Modals;

use App\Models\Assignment;
use App\Models\Employee;
use App\Models\LocationMaster;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddAssignment extends Component
{
    public $empID;
    public $employee_id;
    public $location_id;
    public $date_of_assignment;
    public $from_time;
    public $to_time;
    public $status;

    public function mount($empID = null)
    {
        $this->empID = $empID;
        if ($this->empID) {
            $this->employee_id = $this->empID;
        }
    }

    public function save()
    {
        $this->validate([
            'employee_id' => 'required|exists:employees,id',
            'location_id' => 'required|exists:location_masters,id',
            'date_of_assignment' => 'required|date',
            'from_time' => 'required',
            'to_time' => 'required',
            'status' => 'required',
        ]);

        try {
            DB::beginTransaction();
            Assignment::create([
                'employee_id' => $this->employee_id,
                'location_id' => $this->location_id,
                'date_of_assignment' => $this->date_of_assignment,
                'from_time' => $this->from_time,
                'to_time' => $this->to_time,
                'status' => $this->status,
            ]);
            DB::commit();
            $this->dispatch('operationCompleted');
            $this->dispatch('hideTailwindModal');
            $this->dispatch('swal', ['type' => 'success', 'message' => 'Assignment saved successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('hideTailwindModal');
            $this->dispatch('swal', ['type' => 'error', 'message' => 'Error saving assignment: ' . $e->getMessage()]);
        }
    }


    public function render()
    {
        $employees = Employee::orderBy('full_name', 'ASC')->get();
        $locations = LocationMaster::orderBy('name', 'ASC')->get();
        return view('livewire.modals.add-assignment', compact('employees', 'locations'));
    }
}
