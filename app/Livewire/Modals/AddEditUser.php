<?php

namespace App\Livewire\Modals;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddEditUser extends Component
{
    public $userID;
    public $name;
    public $email;
    public $role;
    public $mobile;

    public function mount($userID = null)
    {
        $this->userID = $userID;
        $user = User::find($this->userID);
        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->role;
            $this->mobile = $user->mobile;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userID,
            'role' => 'required|in:Admin,Police,Verifier',
            'mobile' => 'required|digits:10',
        ]);

        try {
            DB::beginTransaction();
            User::updateOrCreate(
                ['id' => $this->userID],
                [
                    'name' => $this->name,
                    'email' => $this->email,
                    'role' => $this->role,
                    'mobile' => $this->mobile,
                    'password' => Hash::make('default@123#'), // Default password, should be changed later
                ]
            );

            DB::commit();
            $this->dispatch('operationCompleted');
            $this->dispatch('swal', ['type' => 'success', 'message' => 'User saved successfully.']);
            $this->dispatch('hideTailwindModal');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('swal', ['type' => 'error', 'message' => 'An error occurred.' . $e->getMessage()]);
            $this->dispatch('hideTailwindModal');
        }
    }
    public function render()
    {
        return view('livewire.modals.add-edit-user');
    }
}
