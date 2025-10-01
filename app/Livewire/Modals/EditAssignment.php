<?php

namespace App\Livewire\Modals;

use App\Models\Assignment;
use App\Models\Employee;
use App\Models\LocationMaster;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditAssignment extends Component
{
    public $assignmentID;
    public $employee_id;
    public $location_id;
    public $date_of_assignment;
    public $from_time;
    public $to_time;
    public $status;

    public function mount($assignmentID)
    {
        $this->assignmentID = $assignmentID;
        $assignment = Assignment::find($this->assignmentID);
        if ($assignment) {
            $this->employee_id = $assignment->employee_id;
            $this->location_id = $assignment->location_id;
            $this->date_of_assignment = $assignment->date_of_assignment;
            $this->from_time = $assignment->from_time;
            $this->to_time = $assignment->to_time;
            $this->status = $assignment->status;
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
            $assignment = Assignment::find($this->assignmentID);
            $assignment->update([
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
        return view('livewire.modals.edit-assignment', compact('employees', 'locations'));
    }
}
