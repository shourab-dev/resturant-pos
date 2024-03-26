<div class="container">

    <div class="text-end mt-5">
        <a href="{{ route('foods.add') }}" class="main-btn primary-btn rounded-full btn-sm btn-hover" 
            >
            Add Food Items <i class="lni lni-circle-plus"></i>
        </a>
    </div>

    <div class="allFoods card-style mt-5">
        <div class="filterArea"></div>

        <div class="table-responsive table-wrapper ">
            <table class="table striped-table"">
                    <tr class=" text-center">
                <th>#</th>
                <th>Name</th>
                <th>Variation</th>
                <th>Price</th>
                <th>Status</th>
                <th>Featured</th>
                <th></th>
                </tr>
                @forelse ($foods as $key=>$food)

                <tr class="text-center" wire:key="{{ $food->id }}">
                    <td>{{ $foods->firstItem() + $key }}</td>
                    <td class="text-start">
                        @if ($food->image)
                        <img src="{{ asset('storage/'.$food->image) }}" alt="{{ $food->name }}" style="max-width: 80px"
                            class="me-2 rounded">
                        @endif
                        <b>{{ str($food->name)->headline() }}</b>
                    </td>
                    <td>
                        <span class="badge bg-primary">{{ $food->variations }}</span>
                    </td>
                    <td>{{ $food->price }} tk</td>
                    <td>
                        <div class="form-check form-switch toggle-switch d-flex justify-content-center p-0">
                            <input wire:click="updateStatus({{ $food->id }})" class="form-check-input m-auto"
                                type="checkbox" {{ $food->status ? 'checked' : '' }}>
                        </div>
                    </td>
                    <td>
                        <a href="#" wire:click.prevent="updateFeatured({{ $food->id }})" class="text-warning"
                            style="font-size:1.5rem">
                            <i class="lni lni-star-{{ $food->is_featured ? 'fill' : "empty" }}"></i>
                        </a>
                    </td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('foods.add', $food->id) }}" class="text-primary" title="Edit">
                                <i class="lni lni-pencil"></i>
                            </a>
                            <a href="#" wire:click.prevent="deleteFood({{ $food->id }})"
                                wire:confirm="Are you sure, you want to delete {{ str($food->name)->headline() }} item ?"
                                class="text-danger ms-3" title="Delete">
                                <i class="lni lni-trash-can"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="text-center">
                    <td colspan="7">
                        <h5>{{ 'No Food Items Found' }}</h5>
                    </td>
                </tr>
                @endforelse
            </table>

        </div>
    </div>

</div>