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

                    <input wire:model="icon" type="file">
                    <img src="{{ $icon?->temporaryUrl() }}" alt="" class="previewImage w-100 mt-2">
                    <div wire:loading wire:target="icon">
                        Uploading....
                    </div>
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