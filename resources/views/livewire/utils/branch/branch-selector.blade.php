<div class="header-search d-none d-md-flex">
    
    
    <select wire:model="selectedBranch" wire:change="updateBranch" id="" class="form-control ">
        @foreach ($branches as $branch)
            
        <option value="{{ $branch->id }}"  >{{ str($branch->title)->headline() }}</option>
        
        @endforeach
    </select>
</div>