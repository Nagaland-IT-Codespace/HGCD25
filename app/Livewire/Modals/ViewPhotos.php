<?php

namespace App\Livewire\Modals;

use App\Models\Assignment;
use Livewire\Component;

class ViewPhotos extends Component
{
    public $assignmentID;

    public function render()
    {
        $assignment = Assignment::with('photoVerifications')->findOrFail($this->assignmentID);

        return view('livewire.modals.view-photos', [
            'assignment' => $assignment,
            'photos' => $assignment->photoVerifications
        ]);
    }
}
