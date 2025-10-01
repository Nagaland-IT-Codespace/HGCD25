<?php

namespace App\Livewire;

use App\Models\DistrictMaster;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ManageDistricts extends Component
{
    use WithPagination;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $paginationTheme = 'tailwind';

    #[On('operationCompleted')]
    #[Layout('layouts.dashboard-layout', ['title' => 'Manage Districts'])]
    public function render()
    {
        $districts = DistrictMaster::when($this->search, fn($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->orderBy('name')
            ->paginate(10);
        return view('livewire.manage-districts', compact('districts'));
    }
}
