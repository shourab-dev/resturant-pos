<?php

namespace App\Livewire\Utils\Foods;

use App\MediaUploader;
use App\Models\Category;
use App\Models\Food;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddFoodCanvas extends Component
{
    use WithFileUploads, MediaUploader;
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

        $this->validate();



        $food = Food::findOrNew($this->editedId);
        $filePath = $this->uploadMedia($this->foodImg, str($this->name)->slug(), 'foods', $food->image);
        $food->name = $this->name;
        $food->short_detail = $this->shortDetail;
        $food->price = $this->price;
        $food->caution = $this->caution;
        $food->image = $this->foodImg && !is_string($this->foodImg) ? $filePath : $food->image;
        $food->save();
    }

    function mount()
    {
        $this->updateCategory();
    }

    #[On('branchChange')]
    function updateCategory()
    {
        $this->categories = Category::whereHas('branches', function ($q) {
            $q->where('branch_id', auth()->user()->branch_id);
        })->latest()->get();
    }


    public function render()
    {

        return view('livewire.utils.foods.add-food-canvas');
    }
}
