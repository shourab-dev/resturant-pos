<?php

namespace App\Livewire\Utils\Foods;

use App\MediaUploader;
use App\Models\Addon;
use App\Models\Variation;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class AllFoodVariations extends Component
{
    use MediaUploader;
    public $modelName = "App\Models\Variation";
    public $modal;
    #[Reactive]
    public $foodId;

    function placeholder()
    {
        return view('skeleton.placeholder');
    }



    function deleteVariation(Variation $variation)
    {
        $this->removeMedia($variation->food_image);
        $variation->delete();
        $this->dispatch('toast', [
            'type' => "success",
            'msg' => "{$variation->title} has been deleted!",
        ]);
    }
    function deleteAddon(Addon $addon)
    {
        $this->removeMedia($addon->icon);
        $addon->delete();
        $this->dispatch('toast', [
            'type' => "success",
            'msg' => "{$addon->title} has been deleted!",
        ]);
    }




    #[On('variation-added')]
    public function render()
    {
        return view('livewire.utils.foods.all-food-variations', [
            'foodVariations' => $this->modelName::where('food_id', $this->foodId)->get()
        ]);
    }
}
