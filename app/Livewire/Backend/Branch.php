<?php

namespace App\Livewire\Backend;

use App\Models\Branch as BranchModel;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Branch extends Component
{

    public $title;
    public $editedId;

    function rules($id = null)
    {
        return [
            'title' => "required|min:3|max:255|unique:branches,title," . $id
        ];
    }


    function storeOrUpdateBranch()
    {
        $this->validate();

        $branch = BranchModel::findOrNew($this->editedId);

        

        $branch->title = $this->title;
        $branch->slug = str($this->title)->slug();
        $branch->save();
        $type = $this->editedId != null ? 'Updated' : "Added";
        $this->dispatch('toast', [
            'type' => "success",
            'msg' => "Branch has been $type",
        ]);
        $this->reset('title', 'editedId');
        $this->dispatch('refreshBranch', ['branch' => $branch]);
    }



    function editBranch(BranchModel $branch)
    {
        $this->title = $branch->title;
        $this->editedId = $branch->id;
    }



    public function render()
    {

        return view('livewire.backend.branch');
    }
}
