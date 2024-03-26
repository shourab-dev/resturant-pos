<?php

namespace App\Livewire\Backend;

use App\MediaUploader;
use App\Models\Food as ModelsFood;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Foods Management')]

class Food extends Component
{
    use WithPagination, MediaUploader;


    function updateStatus(ModelsFood $food)
    {
        $food->status = !$food->status;
        $food->save();
        $this->dispatch('toast', [
            'type' => "success",
            'msg' => "{$food->name}  status has been updated.",
        ]);
    }
    function updateFeatured(ModelsFood $food)
    {
        $food->is_featured = !$food->is_featured;
        $food->save();
        $type = $food->is_featured ? "added to" : "removed from";
        $this->dispatch('toast', [
            'type' => "success",
            'msg' => "{$food->name} {$type} featured food",
        ]);
    }

    function deleteFood (ModelsFood $food){
        $this->removeMedia($food->image);   
        $food->delete();
        $this->dispatch('toast', [
            'type' => "success",
            'msg' => "{$food->name} has been deleted",
        ]);
    }



    #[On('branchChange')]
    public function render()
    {
        return view('livewire.backend.food', [
            'foods' => ModelsFood::whereHas('categories', function ($q) {
                $q->where('category_id', auth()->user()->branch_id);
            })->withCount('variations as variations')->latest()->paginate(),
        ]);
    }
}
