<div class="table-responsive">
    <table class="table">
        <tr>
            <th>#</th>
            <th>Category</th>
            <th>Branch</th>
            <th></th>
        </tr>
        @forelse ($categories as $key=>$category)
            <tr>
                <td>{{ $categories->firstItem() + $key }}</td>
                <td>
                    @if ($category->icon)
                        <img width="50" class="me-2" src="{{ asset('storage/'.$category->icon) }}" alt="">
                    @endif
                    {{ $category->title }}</td>
                <td>
                    @foreach ($category->branches as $branch)
                        <span class="badge bg-primary d-inline-block">{{ $branch->title }}</span>
                    @endforeach
                </td>
                <td>
                    <div class="action">
                        <button wire:click="$parent.editCategory({{ $category->id }})" class="text-primary" title="edit">
                            <i class="lni lni-pencil"></i>
                        </button>
                        <button wire:confirm="Are you Sure?" class="text-danger" title="delete"
                            wire:click="$parent.deleteCategory({{ $category->id }})">
                            <i class="lni lni-trash-can"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            
        @endforelse
        <tr></tr>
    </table>
</div>
