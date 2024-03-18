<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $profileImage;
    public function render()
    {
        return view('livewire.backend.profile');
    }
}
