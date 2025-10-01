<?php

namespace App\Livewire\Modals;

use App\Models\DistrictMaster;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddEditDistrict extends Component
{
    public $districtID;
    public $name;

    public function mount($districtID = null)
    {
        $this->districtID = $districtID;
        $dist = DistrictMaster::find($this->districtID);
        if ($dist) {
            $this->name = $dist->name;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|unique:district_masters,name,' . $this->districtID,
        ]);

        try {
            DB::beginTransaction();

            DistrictMaster::updateOrCreate(
                ['id' => $this->districtID],
                ['name' => $this->name]
            );
            DB::commit();
            $this->dispatch('swal', ['type' => 'success', 'message' => 'District saved successfully!']);
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
        return view('livewire.modals.add-edit-district');
    }
}
