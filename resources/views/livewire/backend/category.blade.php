<div class="container">

    <div class="row mt-5">
        <div class="col-lg-4">
            <div class="card-style">
                <div class="d-flex justify-content-between align-items-center mb-25">
                    <h5>Manage Category</h5>
                    <button wire:loading.attr="disabled" wire:click="storeOrUpdate"
                        class="main-btn primary-btn square-btn btn-sm btn-hover ">
                        {{ $editedId ? "Edit" : "Add" }} Category
                        <i class="lni lni-{{ $editedId ? " pencil" : "circle-plus" }}"></i>
                    </button>
                </div>

                <div class="input-style-3 position-relative">

                    <input wire:keydown.enter="storeOrUpdate" wire:model="title" type="text"
                        placeholder="Category ( Example: men )">
                    <input type="hidden" wire:model="editedId">
                    <span class="icon"><i class="lni lni-apartment"></i></span>
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-style-1 position-relative">

                    <input wire:model="icon" type="file" id="upload{{ $iteration }}">
                    <img src="{{ $icon?->temporaryUrl() }}" alt="" class="previewImage w-100 mt-2" >
                    <div wire:loading wire:target="icon">
                        Uploading....
                    </div>
                </div>
                <div class="input-style-1 position-relative">

                    <label wire:ignore for="Branches">
                        Select a Branch
                        <select wire:model="branches" class="multiSelectTag  w-100" id="Branches" multiple>
                            @foreach ($allBranches as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>



                @error('icon')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


        </div>
        <div class="col-lg-8">
            <div class="card-style">

            </div>
        </div>
    </div>
</div>


</div>

@assets
<style>
    span {
        display: block !important;
    }
    .select2-selection__choice{
        background-color: transparent !important;
        border: 1px solid dodgerblue !important;
    }
    .select2-selection__choice button{
        border: none !important;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js'
    integrity='sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=='
    crossorigin='anonymous'></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endassets

@script

<script>
    document.addEventListener('livewire:navigated', ()=>{

        $('.multiSelectTag').select2({
            tags: true
        });
        $('.multiSelectTag').on('change',function(){
            $wire.set('branches',$(this).val())
        })
    })
</script>
@endscript