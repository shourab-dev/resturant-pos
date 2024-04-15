<div>
    <div class="input-style-1">
        <input type="text" placeholder="Campaign Name" wire:model="name" />
        @error('name')
        <span class="text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="input-style-1">
                <label for="start">
                    Start Date
                    <input type="datetime-local" placeholder="Campaign Name" id="start" wire:model="start_date" />
                    @error('start_date')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                </label>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="input-style-1">
                <label for="end">
                    End Date
                    <input type="datetime-local" placeholder="Campaign Name" id="end" wire:model="end_date" />
                    @error('end_date')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                </label>
            </div>
        </div>
    </div>
    <div class="input-style-1">
        <textarea wire:model="detail" placeholder="Campaign Detail"></textarea>
    </div>
    <div x-data="{campaignType: 'fixed'}">
        <div class="select-style-1">
            <label for="campaignType">Campaign Type</label>
            <div class="select-position" id="campaignType">
                <select wire:model="campaign_type"
                    x-on:change="campaignType = $event.target.value;console.log(campaignType)">
                    <option selected value="fixed">Fixed Discount</option>
                    <option value="percentage">Percentage Discount</option>
                    <option value="buyToFree">Buy of Get Free</option>
                </select>
            </div>
            @error('campaign_type')
            <span class="text-danger">
                {{ $message }}
            </span>
            @enderror
        </div>
        <div class="input-style-1" x-show="campaignType == 'fixed'">
            <input wire:model="amount" type="text" placeholder="Discount Amount" />
        </div>
        <div class="input-style-1" x-show="campaignType == 'percentage'">
            <input wire:model="amount" type="text" placeholder="Discount Percentage" />
        </div>
        <div class="input-style-1" x-show="campaignType == 'buyToFree'">
            <input wire:model="amount" type="text" placeholder="Get Free Amount" placeholder="Get 1 free" />
        </div>
        @error('amount')
        <span class="text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>

    <div x-data="{discountBy: 'all'}">
        <div class="select-style-1">
            <label for="discountBy">Discount By</label>
            <div class="select-position" id="discountBy">
                <select wire:model="discount_by" x-on:change="discountBy = $event.target.value;">
                    <option selected value="all">All Products</option>
                    <option value="product">By Product</option>
                    <option value="productExclude"> Product Exclude</option>
                    <option value="category">By Category</option>
                    <option value="categoryExclude">Category Exclude</option>
                </select>
            </div>
        </div>
        <div wire:ignore class="input-style-1" x-show="discountBy == 'product' || discountBy == 'productExclude'">
            <input type="hidden" wire:model="productIds[]">
            <select  class="multiSelectTag" multiple data-class="product">
            </select>
        </div>
        <div class="input-style-1" x-show="discountBy == 'category' || discountBy == 'categoryExclude'">
            <select wire:model="categoryIds" class="multiSelectTag" data-class="category" multiple></select>
        </div>
    </div>
    <button wire:click="storeOrUpdate" class="main-btn primary-btn btn-sm square-btn btn-hover w-100">
        Save Campaign

    </button>
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

    .select2-container.select2-container--default.select2-container--open {
        z-index: 999999999999999999999;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endassets


@script

<script>
    document.addEventListener('livewire:navigated', ()=>{
      
        $('.multiSelectTag').select2({
            
            ajax: {
                url: `{{ route('campaign.products') }}`,
                data: function(params){
                     let query = {search: params.term, className: $(this).attr('data-class')}
                     return query;
                },
                processResults: function (data) {
                  
                    console.log(data.results);
                    return {
                        results: data.results
                    };
                },
            },
        });
        $('.multiSelectTag').on('select2:select', function (e) {
            
            $wire.set('productIds', $(this).val())
            
        });
        
        // $('.multiSelectTag').on('change',function(){
        //     let className = $(this).attr('data-class');
        //     if(className == 'product'){
        //         $wire.set('productIds',$(this).val())
        //         let ids = $wire.get('productIds');
        //         // $('.multiSelectTag').val(Object.values(ids)).trigger('change')
        //         $('.multiSelectTag').select2()
        //     }
        // else if(className == 'category'){
        // $wire.set('categoryIds',$(this).val())
        
        // }
        // })

       /**
        *  window.addEventListener('refreshCategoryValues', function(){
            $('.multiSelectTag').val(null).trigger('change')  
        })
         window.addEventListener('updateCategories', function(){
             let categoriesIds = $wire.categoriesIds;
            
             $('.multiSelectTag').val(Object.values(categoriesIds)).trigger('change')  
        })
        * **/
        

    })
    
</script>
@endscript