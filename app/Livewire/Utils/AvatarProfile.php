<?php

namespace App\Livewire\Utils;

use Livewire\Attributes\On;
use Livewire\Component;

class AvatarProfile extends Component
{
    #[On('refreshProfile')]
    public function refresh() { }

    public function render()
    {
        return view('livewire.utils.avatar-profile');
    }
}
