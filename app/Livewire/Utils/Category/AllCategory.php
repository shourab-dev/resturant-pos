<?php

namespace App\Livewire\Utils\Category;

use App\MediaUploader;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class AllCategory extends Component
{
    

    #[On('refreshBranchValues')]
    public function render()
    {
        return view('livewire.utils.category.all-category', [
            'categories' => Category::with('branches:id,title')->select('id', 'title', 'icon')->latest()->simplePaginate(20),
        ]);
    }
}
