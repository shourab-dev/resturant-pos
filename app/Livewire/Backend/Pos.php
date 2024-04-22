<?php

namespace App\Livewire\Backend;

use App\Models\Food;
use App\Models\Order;
use Livewire\Component;
use App\Models\Category;
use App\Models\Customer;
use App\Models\OrderItem;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;

#[Title('Manage Foods')]

class Pos extends Component
{
    public $search;
    public $foods;
    public $selectedCategories = [];

    public $selectedFoods = [];
    public $totalPrice = 0;
    public $selectedCustomer;
    public $customers;


    function mount()
    {
        $foodsItems = Food::whereHas('categories', function ($q) {

            $q->whereHas('branches', function ($query) {
                $query->where('branch_id', auth()->user()->branch_id);
            });
        })->latest()->get();
        $this->foods = $foodsItems;


        $allCustomers = Customer::select('id', 'name')->get();
        $this->selectedCustomer = $allCustomers->first()->id;
        $this->customers = $allCustomers;
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

    #[On('closeModal')]
    function resetFoods()
    {
        $this->selectedFoods = [];
    }

    function placeOrders()
    {

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->customer_id = $this->selectedCustomer;
        $order->total_price = array_sum(array_column($this->selectedFoods, 'total_price'));
        $order->qty = array_sum(array_column($this->selectedFoods, 'quantity'));
        $order->payment = 'cash';
        $order->save();
        foreach ($this->selectedFoods as $foodItem) {


            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->food_id = $foodItem['id'];
            $orderItem->qty = $foodItem['quantity'];
            $orderItem->price = $foodItem['price'];
            $orderItem->total_price = $foodItem['total_price'];
            $orderItem->save();
        }



        $this->dispatch('toast', [
            'type' => "success",
            'msg' => "Your order has been placed",
        ]);
    }
}
