<?php

namespace App\Livewire\Utils\Branch;

use App\Models\Branch;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class AllBranch extends Component
{
    use WithPagination;
    #[On('refreshBranch')]
    public function render()
    {
        return view('livewire.utils.branch.all-branch', [
            'branches' => Branch::select('id', 'title')->latest()->simplePaginate(20),
        ]);
    }
}
