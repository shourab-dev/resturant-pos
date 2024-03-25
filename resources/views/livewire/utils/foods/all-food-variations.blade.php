<div class="mt-25">
    <div class="row">
        
        @foreach ($foodVariations as $foodVariation)
        
        <div class="col-lg-4 mb-3" style="min-height: 200px">
            <div class="card h-100">
                @if ($foodVariation->food_image)
                <img style="max-height: 200px;object-fit:cover;object-position:center;" src="{{ asset('storage/'.$foodVariation->food_image) }}" alt="" class="card-img-top">
                @endif
                <div class="card-body">
                    <h5>
                        {{ str($foodVariation->title)->headline() }}
                    </h5>
                    <p class="my-2">
                        {{ $foodVariation->detail }}
                    </p>
                    <p>{{ $foodVariation->price }} tk</p>
                    <div class="d-flex mt-2 justify-content-end">
                        <a href="#" title="Edit" class="text-primary me-3"><i class="lni lni-pencil"></i></a>
                        <a href="#" title="Danger" class="text-danger"><i class="lni lni-trash-can"></i></a>
                    </div>
                </div>
                
            </div>
        </div>
        @endforeach
    </div>
</div>
