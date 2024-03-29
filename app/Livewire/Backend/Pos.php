<?php

namespace App\Livewire\Backend;

use App\Models\Category;
use App\Models\Food;
use Livewire\Component;

class Pos extends Component
{
    public $search;
    public $foods;
    public $selectedCategories = [];

    public $selectedFoods = [];



    function mount()
    {
        $foodsItems = Food::whereHas('categories', function ($q) {

            $q->whereHas('branches', function ($query) {
                $query->where('branch_id', auth()->user()->branch_id);
            });
        })->latest()->get();
        $this->foods = $foodsItems;
    }
    function updateSelectedCategories($id)
    {
        if (($key = array_search($id, $this->selectedCategories)) !== false) {
            unset($this->selectedCategories[$key]);
        } else {
            array_push($this->selectedCategories, $id);
        }
        $this->updated();
    }

    function updated()
    {

        $query = Food::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        if (count($this->selectedCategories) > 0) {
            $query->whereHas('categories',  function ($q) {
                $q->whereIn('category_id', $this->selectedCategories);
            });
        }


        $foodsItems = $query->whereHas('categories', function ($q) {

            $q->whereHas('branches', function ($query) {
                $query->where('branch_id', auth()->user()->branch_id);
            });
        })->where('status', 1)->get();

        $this->foods = $foodsItems;
    }


    function selectedFoodsItems($food)
    {

        if (($key = array_search($food, $this->selectedFoods)) !== false) {
            unset($this->selectedFoods[$key]);
        } else {
            // array_push($this->selectedFoods, $food);
            $food['quantity'] = 1;
            // array_unshift($this->selectedFoods, $food);
            $this->selectedFoods[] = $food;
        }
    }

    function updateFoodQuantity($key, $quantity)
    {
        if($key !== 0){
        if (array_key_exists($key, $this->selectedFoods)) {
            $this->selectedFoods[$key]['quantity'] = abs($quantity);
        }
        }
    }



    public function render()
    {
        return view('livewire.backend.pos', [
            'categories' => Category::whereHas('branches', function ($q) {
                $q->where('branch_id', auth()->user()->branch_id);
            })->get(),
        ]);
    }
}
