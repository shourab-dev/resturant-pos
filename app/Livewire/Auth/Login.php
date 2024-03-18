<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.auth')]
#[Title('Sign In')]
class Login extends Component
{
    public function render()
    {
        return view('livewire.auth.login');
    }
}
