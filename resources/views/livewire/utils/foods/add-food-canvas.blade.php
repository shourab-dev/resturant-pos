<div class="container-lg">
    <x-modal title="Food Variations" name="variation">
        @slot('modalSlot')
        <livewire:utils.foods.add-variation-foods :foodId="$foodId" />
        @endslot
    </x-modal>
    <x-modal title="Addons" name="addons">
        @slot('modalSlot')
        <livewire:utils.foods.add-addons :foodId="$foodId" />
        @endslot
    </x-modal>

    @if ($currentStep == 1)
    <div class="card-style-3 mt-5 ">
        <div class="d-flex justify-content-between align-items-center mb-25">
            <h5>Add Food</h5>
            <button wire:loading.attr="disabled" wire:click="storeOrUpdate"
                class="main-btn primary-btn square-btn btn-sm btn-hover ">
                {{ $editedId ? "Edit" : "Store" }}
                <i class="lni lni-{{ $editedId ? "pencil" : "circle-plus" }}"></i>
            </button>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="input-style-3 ">

                    <span class="icon"><i class="lni lni-pizza"></i></span>
                    <input wire:model="name" type="text" placeholder="Food Name (Biriyani, Coffee)">

                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-lg-6">
                <div class="input-style-3">

                    <input wire:model="price" type="text" placeholder="Food Price ( 500 tk)">
                    <span class="icon"><i class="lni lni-dollar"></i></span>

                    @error('price')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-6">
                <div class="input-style-3 ">

                    <textarea wire:model="shortDetail" placeholder="Food Short Detail"></textarea>
                    <span class="icon"><i class="lni lni-add-files"></i></span>
                </div>
                @error('shortDetail')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-lg-6">
                <div class="input-style-3 ">

                    <textarea wire:model="caution" placeholder="Cautions"></textarea>
                    <span class="icon"><i class="lni lni-add-files"></i></span>

                    @error('caution')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>


        <input type="hidden" wire:model="editedId">

        <div class="input-style-1 position-relative mb-2">
            <label for="upload{{ $iteration }}">Food Image</label>
            <input wire:model="foodImg" type="file" id="upload{{ $iteration }}">
            <img src="{{ $editedId && is_string($foodImg)  ? asset('storage/'.$foodImg) : $foodImg?->temporaryUrl() }}"
                alt="" class="previewImage  mt-2 w-25">
            <div wire:loading wire:target="foodImg">
                Uploading....
            </div>
            @error('foodImg')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="input-style-1 position-relative">

            <label wire:ignore for="Branches">
                <span>Select Categories <span class="d-inline text-danger">*</span></span>
                <select wire:model="categoriesIds" class="multiSelectTag  w-100" id="categories" multiple>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
                @error('branches')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </label>
        </div>

        <div class="d-lg-flex">
            <div class="form-check form-switch toggle-switch me-3 mb-3 mb-lg-0">
                <input wire:model="status" class="form-check-input" type="checkbox" id="status" checked>
                <label class="form-check-label" for="status">Status</label>
            </div>
            <div class="form-check form-switch toggle-switch">
                <input wire:model="featured" class="form-check-input" type="checkbox" id="featured">
                <label class="form-check-label" for="featured">Featured</label>
            </div>
        </div>



    </div>
    @endif
    @if ($currentStep == 2)
    <div class="card-style-3 mt-5 ">
        <div class="d-flex justify-content-between align-items-center mb-25">
            <h5>Add Food Variations </h5>

            <div>
                <button wire:click="$dispatch('open-modal', {name: 'variation'})"
                    class="main-btn primary-btn square-btn btn-sm btn-hover ">
                    Add
                    <i class="lni lni-circle-plus"></i>
                </button>
                <button class="main-btn primary-btn-outline btn-hover btn-sm" wire:click="nextStep()">Next</button>
            </div>
        </div>
        <livewire:utils.foods.all-food-variations lazy :foodId="$foodId" modal="variation" />


    </div>
    @endif
    @if ($currentStep == 3)
    <div class="card-style-3 mt-5 ">
        <div class="d-flex justify-content-between align-items-center mb-25">
            <h5>Customize Addons</h5>

            <div>
                <button wire:click="$dispatch('open-modal', {name: 'addons'})"
                    class="main-btn primary-btn square-btn btn-sm btn-hover ">
                    Add
                    <i class="lni lni-circle-plus"></i>
                </button>

                <button class="main-btn primary-btn-outline btn-hover btn-sm" wire:click="nextStep('save')">Save Food <i
                        class="lni lni-checkmark"></i></button>
            </div>
        </div>
        <livewire:utils.foods.all-food-variations lazy :foodId="$foodId" modelName="App\Models\Addon" modal="addons" />


    </div>
    @endif

</div>

@assets
<style>
    span {
        display: block !important;
    }

    .select2-selection__choice {
        background-color: transparent !important;
        border: 1px solid dodgerblue !important;
    }

    .select2-selection__choice button {
        border: none !important;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endassets

@script

<script>
    document.addEventListener('livewire:navigated', ()=>{
      
        $('.multiSelectTag').select2();
        $('.multiSelectTag').on('change',function(){
            $wire.set('categoriesIds',$(this).val())
        })

        window.addEventListener('refreshCategoryValues', function(){
            $('.multiSelectTag').val(null).trigger('change')  
        })
         window.addEventListener('updateCategories', function(){
             let categoriesIds = $wire.categoriesIds;
            
             $('.multiSelectTag').val(Object.values(categoriesIds)).trigger('change')  
        })
        

    })
</script>
@endscript