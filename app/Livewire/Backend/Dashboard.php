<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Dashboard')]



class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.backend.dashboard');
    }
}
