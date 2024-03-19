<div class="table-responsive">
    <table class="table">
        <tr>
            <th>#</th>
            <th>Branch </th>
            <th></th>
        </tr>
        @forelse ($branches as $key=>$branch)
        <tr wire:key="{{ $branch->id }}">
            <td>{{  $branches->firstItem() + $key }}</td>
            <td>{{ $branch->title }}</td>
            <td>
                <div class="action">
                    <button wire:click="$parent.editBranch({{ $branch->id }})" class="text-primary" title="edit">
                        <i class="lni lni-pencil"></i>
                    </button>
                    <button class="text-danger" title="delete">
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