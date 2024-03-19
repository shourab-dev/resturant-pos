<?php

namespace App\Livewire\Backend;

use App\Models\Category as ModelsCategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class Category extends Component
{
    use WithFileUploads;
    public $title, $editedId = null, $icon;


    function storeOrUpdate()
    {
        $category = ModelsCategory::findOrNew($this->editedId);
        dd($category);
    }


    public function render()
    {
        return view('livewire.backend.category');
    }
}
