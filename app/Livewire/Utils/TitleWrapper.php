<?php

namespace App\Livewire\Utils;

use Livewire\Component;

class TitleWrapper extends Component
{
    public $title = '';
    public function render()
    {
        return view('livewire.utils.title-wrapper');
    }
}
