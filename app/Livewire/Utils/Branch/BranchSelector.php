<?php

namespace App\Livewire\Utils\Branch;

use App\Models\Branch;
use Livewire\Component;
use Livewire\Attributes\On;

class BranchSelector extends Component
{
    public $selectedId;
    
    #[On('refreshBranch')]
    public function render()
    {
        return view('livewire.utils.branch.branch-selector', [
            'branches' => Branch::where('status',true)->select('id','title')->latest()->get()
        ]);
    }
}
