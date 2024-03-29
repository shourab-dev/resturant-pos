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

    <div class="row align-items-center">
        <div class="card-style mt-5 col-lg-8">
            <h4 class="mb-25">Profile Setting</h4>
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="loaderWrapper mx-auto" x-data="{ uploading: false, progress: 0 }"
                        x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false"
                        x-on:livewire-upload-cancel="uploading = false" x-on:livewire-upload-error="uploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <label for="profileImage">
                            @if (!$profileImage)
                            <img src="{{ getProfileImage(200) }}" alt="" class="previewImage">
                            @else
                            <img src="{{ $profileImage->temporaryUrl() }}" alt="" class="previewImage">
                            @endif
                        </label>
                        <input type="file" id="profileImage" wire:model="profileImage" class="d-none">
                        @error('profileImage')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div x-show="uploading" class="loaderProgress">
                            <div class="d-flex">
                                <span x-text="progress">
                                </span>%<div class="spinner-border" role="status"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="text-end">
                        <button wire:loading.attr="disabled" wire:click="updateProfile"
                            class="main-btn primary-btn square-btn btn-sm btn-hover ">
                            Save
                            <i class="lni lni-checkmark-circle"></i>
                        </button>
                    </div>
                    <br>
                    <div class="input-style-3 position-relative">
                        <input wire:keydown.enter="updateProfile" wire:model="name" value="{{ auth()->user()->name }}"
                            type="text" placeholder="Full Name">
                        <span class="icon"><i class="lni lni-user"></i></span>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-style-3">
                        <input wire:keydown.enter="updateProfile" value="{{ auth()->user()->email }}" type="email"
                            placeholder="Email" wire:model="email">
                        <span class="icon"><i class="lni lni-envelope"></i></span>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            </form>
        </div>
        <div class="col-lg-4">
            <div class="card-style mt-5">
                <div class="d-flex justify-content-between align-items-center mb-25">
                    <h5>Password Update</h5>
                    <button wire:loading.attr="disabled" wire:click="updatePassword"
                        class="main-btn primary-btn square-btn btn-sm btn-hover ">
                        Save
                        <i class="lni lni-checkmark-circle"></i>
                    </button>
                </div>

                <div class="input-style-3 position-relative">
                    <input wire:model.blur="old" type="password" placeholder="Old Password">
                    <span class="icon"><i class="lni lni-lock-alt"></i></span>
                    @error('old')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-style-3 position-relative">

                    <input wire:model="password" type="password" placeholder="New Password">
                    <span class="icon"><i class="lni lni-lock-alt"></i></span>
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-style-3 position-relative">
                    <input wire:model="password_confirmation" type="password" placeholder="Confirm Password">
                    <span class="icon"><i class="lni lni-lock-alt"></i></span>
                    @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>



            </div>
        </div>
    </div>

</div>