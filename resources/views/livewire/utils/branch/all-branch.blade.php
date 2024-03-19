<div class="table-responsive">
    <table class="table">
        <tr>
            <th>#</th>
            <th>Branch </th>
            <th>Status</th>
            <th></th>
        </tr>
        @forelse ($branches as $key=>$branch)
        <tr wire:key="{{ $branch->id }}" wire:transition>
            <td>{{  $branches->firstItem() + $key }}</td>
            <td>{{ $branch->title }}</td>
            <td>
                <div class="form-check form-switch toggle-switch">
                    <input wire:input="$parent.updateStatus({{ $branch->id }})" class="form-check-input" type="checkbox" id="toggleSwitch2" {{ $branch->status ?  'checked' : ''}} >
                    
                </div>
            </td>
            <td>
                <div class="action">
                    <button wire:click="$parent.editBranch({{ $branch->id }})" class="text-primary" title="edit">
                        <i class="lni lni-pencil"></i>
                    </button>
                    <button wire:confirm="Are you Sure?" class="text-danger" title="delete" wire:click="$parent.delteBranch({{ $branch->id }})">
                        <i class="lni lni-trash-can"></i>
                    </button>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">No Branch Found</td>
        </tr>
        @endforelse

    </table>
    
        {{ $branches->links() }}
    
</div>