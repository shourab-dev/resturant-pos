<?php

namespace App\Livewire\Backend;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Storage;

#[Title('Profile Page')]
class Profile extends Component
{
    use WithFileUploads;
    #[Rule('mimes:jpg,png|nullable')]
    public $profileImage;
    #[Rule('required')]
    public $name;
    #[Rule('required|email')]
    public $email;


    function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
    }


    function updateProfile()
    {
        $this->validate();

        if ($this->profileImage) {
            if (auth()->user()->profile_url) {
                Storage::disk('public')->delete(auth()->user()->profile_url);
            }
            $profileImage = $this->profileImage->store('users', 'public');
        }


        $user = User::findOrFail(auth()->user()->id);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->profile_url = $profileImage ?? null;
        $user->save();
    }




    public function render()
    {
        return view('livewire.backend.profile');
    }
}
