<?php

namespace App\Livewire\Utils\Foods;



use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class AllFoodVariations extends Component
{
    public $modelName = "App\Models\Variation";
    public $modal;
    #[Reactive]
    public $foodId;

    function placeholder()
    {
        return view('skeleton.placeholder');
    }


    #[On('variation-added')]
    public function render()
    {
        return view('livewire.utils.foods.all-food-variations', [
            'foodVariations' => $this->modelName::where('food_id', $this->foodId)->get()
        ]);
    }
}
