<?php

namespace App\Livewire\Utils\Foods;

use App\Models\Variation;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class AllFoodVariations extends Component
{
    #[Reactive]
    public $foodId ;

    function placeholder()
    {
        return view('skeleton.placeholder');
    }


    #[On('variation-added')]
    public function render()
    {
        return view('livewire.utils.foods.all-food-variations', [
            'foodVariations' => Variation::where('food_id', $this->foodId)->get()
        ]);
    }
}
