@assets
<style>
    label {
        display: block;
        width: fit-content;
        margin: auto;
    }

    .previewImage {
        max-width: 100%;
        border-radius: 50%;
        width: 200px;
        height: 200px;
        object-fit: cover
    }
</style>
@endassets
<div class="container">

    <div class="card-style mt-5 col-lg-8">
        <h4 class="mb-25">Profile Setting</h4>

        <form>
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div x-data="{ uploading: true, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-cancel="uploading = false"
                        x-on:livewire-upload-error="uploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">

                        <label for="profileImage">
                            @if (!$profileImage)
                            <img src="{{ getProfileImage(200) }}" alt="" class="previewImage">
                            @else
                            <img src="{{ $profileImage->temporaryUrl() }}" alt="" class="previewImage">
                            @endif
                        </label>
                        <input type="file" id="profileImage" wire:model="profileImage" class="d-none">
                        <div x-show="uploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>

                </div>
                <div class="col-lg-8">

                    <div class="text-end">
                        <button class="main-btn primary-btn square-btn btn-sm btn-hover ">
                            Save
                            <i class="lni lni-checkmark-circle"></i>
                        </button>
                    </div>

                    <br>
                    <div class="input-style-3 position-relative">
                        <input type="text" placeholder="Full Name">
                        <span class="icon"><i class="lni lni-user"></i></span>
                    </div>
                    <div class="input-style-3">
                        <input type="email" placeholder="Email">
                        <span class="icon"><i class="lni lni-envelope"></i></span>
                    </div>
                </div>
            </div>
        </form>

    </div>

</div>