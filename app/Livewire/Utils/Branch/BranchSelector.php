<?php

namespace App\Livewire\Utils\Branch;

use App\Models\User;
use App\Models\Branch;
use Livewire\Component;
use Livewire\Attributes\On;

class BranchSelector extends Component
{
    public  $selectedBranch;


    function mount()
    {
        $this->selectedBranch = auth()->user()->branch_id;
    }


    function updateBranch()
    {
        $user = User::findOrFail(auth()->id());
        $user->branch_id = $this->selectedBranch;
        $user->save();
        $branchTitle = $user->branch()->first('title')->title;
        
        $this->dispatch('toast', [
            'type' => "success",
            'msg' => "Switch to $branchTitle branch",
        ]);
        $this->dispatch('branchChange');
    }

    #[On('refreshBranch')]
    public function render()
    {
        return view('livewire.utils.branch.branch-selector', [
            'branches' => Branch::where('status', true)->select('id', 'title')->latest()->get()
        ]);
    }
}
