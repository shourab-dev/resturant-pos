<div class="mt-25">
    <div class="row">

        @foreach ($foodVariations as $foodVariation)

        <div wire:key="{{ $foodVariation->id }}" class="col-lg-4 mb-3" style="min-height: {{ $foodVariation->icon ? "
            auto" : '200px' }}">
            <div class="card h-100">
                @if ($foodVariation->food_image)
                <img style="max-height: 200px;object-fit:cover;object-position:center;"
                    src="{{ asset('storage/'.$foodVariation->food_image ) }}" alt="" class="card-img-top">
                @endif

                <div class="card-body {{ $foodVariation->icon ? " row" : '' }}">
                    @if ($foodVariation->icon)
                    <div class="col-3">
                        <img style="max-width: 80px;" src="{{ asset('storage/'.$foodVariation->icon ) }}" alt=""
                            class="rounded">
                    </div>
                    @endif
                    <div class="{{ $foodVariation->icon ? " col-9" : '' }}">
                        <h5>
                            {{ str($foodVariation->title)->headline() }}
                        </h5>
                        <p class="my-2">
                            {{ $foodVariation->detail }}
                        </p>
                        <p>{{ $foodVariation->price }} tk</p>
                        <div class="d-flex mt-2 justify-content-end">
                            <a href="#"
                                wire:click.prevent="$dispatch('open-modal', {name: '{{ $modal }}', id: {{ $foodVariation->id }}})"
                                title="Edit" class="text-primary me-3"><i class="lni lni-pencil"></i></a>
                            @if ($modal == 'variation')
                            <a href="#" wire:confirm="Are you sure, you want to delete {{ $foodVariation->title }} ?" wire:click.prevent="deleteVariation({{ $foodVariation->id }})" title="Danger" class="text-danger"><i
                                    class="lni lni-trash-can"></i></a>
                            @endif
                            @if ($modal == 'addons')
                            <a href="#" wire:confirm="Are you sure, you want to delete {{ $foodVariation->title }} ?" wire:click.prevent="deleteAddon({{ $foodVariation->id }})" title="Danger" class="text-danger"><i
                                    class="lni lni-trash-can"></i></a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>