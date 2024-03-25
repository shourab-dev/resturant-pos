<?php

namespace App\Livewire\Utils\Foods;

use App\Models\Addon;
use App\MediaUploader;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Livewire\Attributes\Reactive;

class AddAddons extends Component
{
    use WithFileUploads, MediaUploader;

    public $title, $price, $addon_image, $editedId;
    #[Reactive]
    public $foodId;


    #[On('open-modal')]
    function updateProperties($name, $id = null)
    {
        if ($name == 'addons') {
            if ($id) {
                $addon = Addon::select('id', 'price', 'title')->find($id);
                $this->editedId = $addon->id;
                $this->title = $addon->title;
                $this->price = $addon->price;
            } else {
                $this->reset('editedId', 'title', 'price');
            }
        }
    }

    public function saveOrUpdate()
    {

        $addons  = Addon::findOrNew($this->editedId);
        $addons->title = $this->title;
        $addons->food_id = $this->foodId;
        $addons->price = $this->price;

        if ($this->addon_image) {
            $icon =  $this->uploadMedia($this->addon_image, str()->slug($this->title . time()), 'addons', $this->addon_image);
        }

        $addons->icon = $icon ?? $addons->icon;
        $addons->save();
        $this->dispatch('close-modal');
        $this->reset('editedId', 'title', 'price');
        $this->dispatch('variation-added');
        
    }

    public function render()
    {
        return view('livewire.utils.foods.add-addons');
    }
}
