<?php

namespace App\Livewire;

use App\Models\DistrictMaster;
use App\Models\LocationMaster;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ManageLocations extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';


    public $search = '';
    public $districtSearch = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $location = LocationMaster::find($id);
        if ($location) {
            $location->assignments()->delete();
            $location->delete();
            $this->dispatch('swal', ['type' => 'success', 'message' => 'Location deleted successfully!']);
            $this->dispatch('operationCompleted');
        } else {
            $this->dispatch('swal', ['type' => 'error', 'message' => 'Location not found!']);
        }
    }

    #[On('operationCompleted')]
    #[Layout('layouts.dashboard-layout', ['title' => 'Manage Locations'])]
    public function render()
    {
        $locations = LocationMaster::when($this->search, fn($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->districtSearch, fn($query) => $query->where('district_id', $this->districtSearch))
            ->orderBy('name')
            ->paginate(10);

        $districts = DistrictMaster::orderBy('name')->get();
        return view('livewire.manage-locations', compact('locations', 'districts'));
    }
}
