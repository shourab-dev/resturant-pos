<?php

namespace App\Livewire\Utils\Foods;

use App\MediaUploader;
use App\Models\Variation;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Foods Management')]




class AddVariationFoods extends Component
{
    use WithFileUploads, MediaUploader;


    public $title, $image, $price, $detail,  $editedId;

    #[Reactive]
    public $foodId;

    function rules()
    {
        return [
            'title' => "required|min:3|unique:variations,title," . $this->editedId,
            'image' => 'nullable|image',
            'price' => 'nullable|numeric'
        ];
    }

    #[On('open-modal')]
    function updateProperties($name, $id = null)
    {
        if ($name == 'variation') {
            if ($id) {
                $variation = Variation::select('id', 'price', 'detail', 'title')->find($id);
                $this->editedId = $variation->id;
                $this->title = $variation->title;
                $this->price = $variation->price;
                $this->detail = $variation->detail;
            } else{
                $this->reset('editedId','title','price', 'detail');
            }
        }
    }



    function storeOrUpdateVariation()
    {

        $this->validate();

        $variation = Variation::findOrNew($this->editedId);
        if ($this->image) {
            $file = $this->uploadMedia($this->image, str()->slug($this->title), 'foods', $variation->food_image);
        }
        $variation->title = $this->title;
        $variation->food_id = $this->foodId;
        $variation->price = $this->price;
        $variation->detail = $this->detail;
        $variation->food_image = $file ?? $variation->food_image;
        $variation->save();

        $this->dispatch('toast', [
            'type' => "success",
            'msg' => "Food Variation has been added",
        ]);
        $this->dispatch('close-modal');
        $this->dispatch('variation-added');
    }

    public function render()
    {
        // dd($this->foodId);
        return view('livewire.utils.foods.add-variation-foods');
    }
}
