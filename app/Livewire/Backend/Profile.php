<?php

namespace App\Livewire\Backend;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;

#[Title('Profile Page')]
class Profile extends Component
{
    use WithFileUploads;

    public $profileImage;

    public $name;

    public $email;

    #[Validate]
    public $old;

    public $password;

    public $password_confirmation;


    function rules()
    {
        return [
            'name' => "required|min:3",
            'email' => "required|email|unique:users,email," . auth()->user()->id,
            'profileImage' => 'mimes:jpg,png|nullable',
            'password' => 'required|min:8|confirmed',
            'old' => 'required|min:8|current_password:web'
        ];
    }

    function mount()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
    }

    function updatePassword()
    {
        $this->validateOnly('password');

        $user = User::findOrFail(auth()->user()->id);
        $user->password = Hash::make($this->password);
        $user->save();
        $this->reset('old','password','password_confirmation');
        $this->dispatch('toast', [
            'type' => 'success',
            'msg' => "Password Updated"
        ]);
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
        $user->profile_url = $profileImage ?? auth()->user()->profile_url;
        $user->save();
        session()->flash('success', 'Profile Updated');
        $this->dispatch('refreshProfile');
        $this->dispatch('toast', [
            'type' => 'success',
            'msg' => "Profile Updated"
        ]);
    }




    public function render()
    {
        return view('livewire.backend.profile');
    }
}
