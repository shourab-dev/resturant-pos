<?php

namespace App\Livewire\Utils\Foods;

use App\Models\Food;
use App\MediaUploader;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;

#[Title('Foods Management')]

class AddFoodCanvas extends Component
{
    use WithFileUploads, MediaUploader;
    public $editedId, $name, $shortDetail, $price, $caution, $foodImg, $iteration, $status = true, $featured = false, $categoriesIds, $categories = [];
    public $steps = 3, $currentStep = 1;
    public $foodId = null; //* this will be null




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
        if ($this->editedId) {
            $this->validate([
                'foodImg' => 'required'
            ]);
            $this->validateOnly('name');
            $this->validateOnly('price');
        } else {
            $this->validate();
        }



        $food = Food::findOrNew($this->editedId);
        $filePath = $this->uploadMedia($this->foodImg, str($this->name)->slug(), 'foods', $food->image);
        $food->name = $this->name;
        $food->short_detail = $this->shortDetail;
        $food->price = $this->price;
        $food->caution = $this->caution;
        $food->status = $this->status;
        $food->is_featured = $this->featured;
        $food->image = $this->foodImg && !is_string($this->foodImg) ? $filePath : $food->image;

        $this->reset('name', 'price', 'caution', 'status', 'featured', 'shortDetail', 'foodImg');
        $food->save();
        $this->foodId = $food->id;

        $food->categories()->sync($this->categoriesIds);
        $this->dispatch('refreshCategoryValues');
        $this->iteration++;
        $this->currentStep++;
    }

    function nextStep($type = 'next')
    {
        if ($type == 'next') {
            if ($this->currentStep < $this->steps) {
                $this->currentStep++;
            }
        } else if ('save') {
            $this->currentStep = 1;
            $this->redirectRoute(name: 'foods.view', navigate: true);
            $this->dispatch('toast', [
                'type' => "success",
                'msg' => "Your food Has been Added",
            ]);
        }
    }



    function mount($id = null)
    {

        if ($id) {
            $this->editedId = $id;
            $food = Food::find($id);
            $this->name = $food->name;
            $this->shortDetail = $food->short_detail;
            $this->price = $food->price;
            $this->caution = $food->caution;
            $this->status = $food->status;
            $this->featured = $food->is_featured;
            $this->foodImg = $food->image;
            $this->categoriesIds = $food->categories()->get()->pluck('id');
            $this->dispatch('updateCategories');
        }


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
