<?php

namespace App\Livewire\Backend;

use App\Models\Branch;
use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\WithFileUploads;
use App\Models\Category as ModelsCategory;


class Category extends Component
{
    use WithFileUploads;
    public $title, $editedId = null, $icon, $branches = [], $iteration;



    function rules()
    {
        return [
            'title' => "required|min:3|unique:categories,title," . $this->editedId,
            'icon' => 'nullable|image',
        ];
    }

    function storeOrUpdate()
    {
        $this->validate();

        if ($this->icon) {
            $iconName = str($this->title)->slug() . "." . $this->icon->getClientOriginalExtension();
            $filePath = $this->icon->storeAs('categories', $iconName, 'public');
        }

        $category = ModelsCategory::findOrNew($this->editedId);
        $category->title = $this->title;
        $category->slug = str($this->title)->slug();
        $category->icon = $this->icon ? $filePath : $category->icon;
        $category->save();
        $branchIds = $this->createTagableBranch();
        $category->branches()->sync($branchIds);
        $this->reset('title', 'editedId', 'icon', 'branches');
        $this->iteration++;
        $this->dispatch('refreshBranchValues');
    }

    private function createTagableBranch()
    {
        $newBranchIds = [];
        foreach ($this->branches as $branchId) {
            $item =  Branch::firstOrCreate([
                'id' => $branchId
            ], [
                'title' => $branchId,
                'slug' => str($branchId)->slug()
            ]);
            $newBranchIds[] = $item->id;
        }
        return $newBranchIds;
    }

    function editCategory(ModelsCategory $category)
    {
        $this->editedId = $category->id;
        $this->title = $category->title;
        $this->icon = $category->icon;
        $this->branches = $category->branches()->get()->pluck('id');
        $this->dispatch('updateBranches');
    }


    public function render()
    {
        

        return view('livewire.backend.category', [
            'allBranches' => Branch::select('id', 'title')->latest()->get()
        ]);
    }
}
