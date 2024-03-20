<div class="header-search d-none d-md-flex">
    
    
    <select name="" id="" class="form-control ">
        @foreach ($branches as $branch)
            
        <option value="{{ $branch->id }}" {{ $branch->id == $selectedId ? "selected" : "" }} >{{ $branch->title }}</option>
        
        @endforeach
    </select>
</div>