<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ManageUsers extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $search = '';
    public $roleSearch = '';
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingRoleSearch()
    {
        $this->resetPage();
    }

    #[On('operationCompleted')]
    #[Layout('layouts.dashboard-layout', ['title' => 'Manage Users'])]
    public function render()
    {
        $users = User::when($this->search, fn($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->roleSearch, fn($query) => $query->where('role', $this->roleSearch))
            ->orderBy('name', 'ASC')->paginate(10);
        return view('livewire.manage-users', compact('users'));
    }
}
