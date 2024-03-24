<?php

namespace App\Livewire\Utils\Foods;

use App\MediaUploader;
use App\Models\Variation;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Foods Management')]




class AddVariationFoods extends Component
{
    use WithFileUploads, MediaUploader;


    public $title, $image, $price, $detail, $foodId, $editedId;


    function rules()
    {
        return [
            'title' => "required|min:3|unique:variation,title," . $this->editedId,
            'image' => 'nullable|image',
            'price' => 'nullable|numeric'
        ];
    }

    function storeOrUpdateVariation()
    {

        $this->validate();

        $variation = Variation::findOrNew($this->editedId);
        if ($this->image) {
            $file = $this->uploadMedia($this->image, str()->slug($this->title), 'foods', $variation->food_image);
        }
        $variation->title = $this->title;
        $variation->price = $this->price;
        $variation->detail = $this->detail;
        $variation->food_image = $file ?? $variation->food_image;
        $variation->save();

        $this->dispatch('toast', [
            'type' => "success",
            'msg' => "Food Variation has been added",
        ]);
        $this->dispatch('close-modal');
    }

    public function render()
    {
        return view('livewire.utils.foods.add-variation-foods');
    }
}
