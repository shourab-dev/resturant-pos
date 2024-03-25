<?php

namespace App\Livewire\Utils\Foods;

use App\MediaUploader;
use App\Models\Addon;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddAddons extends Component
{
    use WithFileUploads, MediaUploader;

    public $title, $price, $addon_image, $editedId;
    #[Reactive]
    public $foodId;


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
        $this->dispatch('variation-added');
    }

    public function render()
    {
        return view('livewire.utils.foods.add-addons');
    }
}
