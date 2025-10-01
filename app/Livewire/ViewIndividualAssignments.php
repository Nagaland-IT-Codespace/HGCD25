<?php

namespace App\Livewire;

use App\Models\Assignment;
use App\Models\Employee;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewIndividualAssignments extends Component
{
    public $empID;

    public function mount($empID)
    {
        $this->empID = $empID;
    }

    public function delete($id)
    {
        $assignment = Assignment::find($id);
        if ($assignment) {
            $assignment->photoVerifications()->delete();
            $assignment->delete();
            session()->flash('message', 'Assignment deleted successfully.');
        } else {
            session()->flash('error', 'Assignment not found.');
        }
    }

    #[On('operationCompleted')]
    #[Layout('layouts.dashboard-layout', ['title' => 'Assignments'])]
    public function render()
    {
        $emp = Employee::find($this->empID);
        $assignments = Assignment::where('employee_id', $this->empID)->orderBy('date_of_assignment', 'DESC')->get();
        return view('livewire.view-individual-assignments', compact('emp', 'assignments'));
    }
}
