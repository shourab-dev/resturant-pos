<div>
    <input type="text" wire:model="foodId">
    <div class="input-style-1">
        <input type="text" placeholder="Addon Name"  wire:model="title">
    </div>
    <div class="input-style-1">
        <input type="text" placeholder="Addon Price" wire:model="price">
    </div>
    <div class="input-style-1">
        <label for="addon_img">Addon Image</label>
        <input type="file" placeholder="Addon Name" id="addon_img" wire:model="addon_image">
    </div>
    <button  class="main-btn primary-btn square-btn btn-hover btn-sm w-100" wire:click="saveOrUpdate">
        Add Addon
        <i class="lni lni-add"></i>
    </button>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
</div>
