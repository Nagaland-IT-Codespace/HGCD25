<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListAssignments extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    public $search = '';
    public $date_filter;

    
    #[On('operationCompleted')]
    #[Layout('layouts.dashboard-layout', ['title' => 'Manage Assignments'])]
    public function render()
    {
        $assignments = \App\Models\Assignment::with(['employee', 'location'])
            ->when($this->search, function ($query) {
                $query->whereHas('employee', function ($q) {
                    $q->where('full_name', 'like', '%' . $this->search . '%');
                })->orWhereHas('location', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->date_filter, function ($query) {
                $query->whereDate('date_of_assignment', $this->date_filter);
            })
            ->latest()
            ->paginate(10);
        return view('livewire.list-assignments', compact('assignments'));
    }
}
