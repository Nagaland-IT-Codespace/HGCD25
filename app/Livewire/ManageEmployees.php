<?php

namespace App\Livewire;

use App\Models\DistrictMaster;
use App\Models\Employee;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ManageEmployees extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $districtSearch = '';
    public $genderSearch = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingDistrictSearch()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->districtSearch = '';
        $this->resetPage();
    }

    public function delete($id)
    {
        $employee = Employee::find($id);
        if ($employee) {
            $employee->assignments()->delete();
            $employee->delete();
            session()->flash('message', 'Employee deleted successfully.');
        } else {
            session()->flash('error', 'Employee not found.');
        }
    }

    #[On('operationCompleted')]
    #[Layout('layouts.dashboard-layout', ['title' => 'Manage Employees'])]
    public function render()
    {
        $employees = Employee::when($this->search, fn($query) => $query->where('full_name', 'like', '%' . $this->search . '%'))
            ->when($this->districtSearch, fn($query) => $query->where('district', $this->districtSearch))
            ->when($this->genderSearch, fn($query) => $query->where('gender', $this->genderSearch))
            ->orderBy('full_name', 'ASC')
            ->paginate(10);
        $districts = DistrictMaster::orderBy('name', 'ASC')->get();
        return view('livewire.manage-employees', compact('employees', 'districts'));
    }
}
