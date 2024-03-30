<?php

namespace App\Livewire\Backend;

use App\Models\Category;
use App\Models\Food;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Manage Foods')]

class Pos extends Component
{
    public $search;
    public $foods;
    public $selectedCategories = [];

    public $selectedFoods = [];
    public $totalPrice = 0;


    
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

        if (count($this->selectedFoods) === 0) {
            $food['quantity'] = 1;
            $food['total_price'] = $food['price'] * $food['quantity'];
            $this->selectedFoods[] = $food;
        } else {

            foreach ($this->selectedFoods as $key => $foodItem) {
                // dd($foodItem['id'] === $food['id']);
                if ($result = $foodItem['id'] === $food['id']) {

                    unset($this->selectedFoods[$key]);
                    break;
                }
            }
            if (!$result) {
                $food['quantity'] = 1;
                $food['total_price'] = $food['price'] * $food['quantity'];
                $this->selectedFoods[] = $food;
            }
        }

        $this->totalPrice = array_sum(array_column($this->selectedFoods, 'total_price'));
    }


    function removeFoodItem($food)
    {

        foreach ($this->selectedFoods as $key => $foodItem) {
            if ($foodItem['id'] === $food['id']) {
                unset($this->selectedFoods[$key]);
                $this->dispatch('toast', [
                    'type' => "success",
                    'msg' => str($food['name'])->headline() . " has been removed",
                ]);
                $this->dispatch('remove-selected-food', [
                    'id' => $food['id']
                ]);
                break;
            }
        }
        $this->totalPrice = array_sum(array_column($this->selectedFoods, 'total_price'));
    }

    function updateFoodQuantity($key, $quantity)
    {
        if ($quantity !== 0 && is_numeric($quantity)) {
            if (array_key_exists($key, $this->selectedFoods)) {
                $this->selectedFoods[$key]['quantity'] = abs($quantity);
                $this->selectedFoods[$key]['total_price'] =  $this->selectedFoods[$key]['price'] * $this->selectedFoods[$key]['quantity'];
            }
            $this->totalPrice = array_sum(array_column($this->selectedFoods, 'total_price'));
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
