<?php

namespace App\Livewire\Backend;

use App\Livewire\Utils\Category\AllCategory;
use App\MediaUploader;
use App\Models\Branch;
use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\WithFileUploads;
use App\Models\Category as ModelsCategory;


class Category extends Component
{
    use WithFileUploads, MediaUploader;
    public $title, $editedId = null, $icon, $branches = [], $iteration;



    function rules()
    {
        return [
            'title' => "required|min:3|unique:categories,title," . $this->editedId,
            'icon' => 'nullable',
        ];
    }

    function storeOrUpdate()
    {
        $this->validate();


        $category = ModelsCategory::findOrNew($this->editedId);
        $filePath = $this->uploadMedia($this->icon, str($this->title)->slug(), 'categories', $category->icon);
        $category->title = $this->title;
        $category->slug = str($this->title)->slug();
        $category->icon = $this->icon && !is_string($this->icon) ? $filePath : $category->icon;
        $category->save();
        $branchIds = $this->createTagableBranch();
        $category->branches()->sync($branchIds);
        $this->reset('title', 'editedId', 'icon', 'branches');
        $this->iteration++;
        $type = $this->editedId != null ? 'Updated' : "Added";

        $this->dispatch('toast', [
            'type' => "success",
            'msg' => "Category has been $type",
        ]);
        $this->dispatch('refreshBranchValues');
    }



    function deleteCategory(ModelsCategory $category)
    {
        $this->removeMedia($category->icon);
        $category->delete();
        $this->dispatch('toast', [
            'type' => "success",
            'msg' => "{$category->title} has been removed",
        ]);
        $this->dispatch('refreshBranchValues')->to(AllCategory::class);
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
            'allBranches' => Branch::where('status', true)->select('id', 'title')->latest()->get()
        ]);
    }
}
