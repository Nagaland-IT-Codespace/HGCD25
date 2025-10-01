<?php

namespace App\Livewire\Modals;

use App\Models\DistrictMaster;
use App\Models\LocationMaster;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddEditLocation extends Component
{
    public $locationID;
    public $name;
    public $address;
    public $district_id;

    public function mount($locationID = null)
    {
        $this->locationID = $locationID;
        $loc = LocationMaster::find($this->locationID);
        if ($loc) {
            $this->name = $loc->name;
            $this->address = $loc->address;
            $this->district_id = $loc->district_id;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|unique:location_masters,name,' . $this->locationID,
            'address' => 'required',
            'district_id' => 'required|exists:district_masters,id',
        ]);

        try {
            DB::beginTransaction();
            LocationMaster::updateOrCreate(
                ['id' => $this->locationID],
                [
                    'name' => $this->name,
                    'address' => $this->address,
                    'district_id' => $this->district_id,
                ]
            );
            DB::commit();

            $this->dispatch('swal', ['type' => 'success', 'message' => 'Location saved successfully!']);
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
        $districts = DistrictMaster::orderBy('name')->get();
        return view('livewire.modals.add-edit-location', compact('districts'));
    }
}
