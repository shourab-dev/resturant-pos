<div>
    
    <input type="hidden" wire:model="foodId">
    <div class="input-style-1">
        <input type="text" wire:model="title" placeholder="Food Variation Name">
        @error('title')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="input-style-1">
        <label for="image">Food Image</label>
        <input type="file" wire:model="image">
        @error('image')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="input-style-1">
        <input type="number" wire:model="price" placeholder="Food Price">
        @error('price')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="input-style-1">
        <textarea wire:model="detail" placeholder="Detail"></textarea>
    </div>
    <button wire:loading.attr="disabled" wire:click="storeOrUpdateVariation"
        class="main-btn primary-btn square-btn btn-sm btn-hover w-100">
        Add Variation
        <i class="lni lni-circle-plus"></i>
    </button>
</div>