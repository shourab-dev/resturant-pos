<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Foods Management')]

class Food extends Component
{
    public function render()
    {
        return view('livewire.backend.food');
    }
}
