<div class="container">

    <div class="row mt-5">
        <div class="col-lg-4">
            <div class="card-style">
                <div class="d-flex justify-content-between align-items-center mb-25">
                    <h5>Manage Branch</h5>
                    <button wire:loading.attr="disabled" wire:click="storeOrUpdateBranch"
                        class="main-btn primary-btn square-btn btn-sm btn-hover ">
                        {{ $editedId ? "Edit" : "Store" }} Branch
                        <i class="lni lni-circle-plus"></i>
                    </button>
                </div>

                <div class="input-style-3 position-relative">

                    <input wire:keydown.enter="storeOrUpdateBranch" wire:model="title" type="text"
                        placeholder="Branch name">
                    <input type="hidden" wire:model="editedId">
                    <span class="icon"><i class="lni lni-apartment"></i></span>
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
        <div class="col-lg-8">
            <div class="card-style">
                @livewire('utils.branch.all-branch')
            </div>
        </div>
    </div>


</div>