<?php

namespace App\Livewire\Utils\Foods;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddFoodCanvas extends Component
{
    use WithFileUploads;
    public $editedId, $name, $shortDetail, $price, $caution, $foodImg, $iteration, $status = true, $featured = false, $categoriesIds, $categories = [];

    function rules()
    {
        return [
            'name' => "required|min:3",
            'price' => 'required|numeric',
            'foodImg' => "required|image"
        ];
    }

    function storeOrUpdate()
    {
        dd($this->categories);
        $this->validate();

    }

    function mount()
    {
        $this->categories = Category::whereHas('branches', function ($q) {
            $q->where('branch_id', 2);
        })->latest()->get();
    }


    public function render()
    {

        return view('livewire.utils.foods.add-food-canvas');
    }
}
