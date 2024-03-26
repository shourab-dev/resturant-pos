<div>
    <div class="card-style mt-5">
        <div class="searchBar  ">
            <div class="input-style-1 mb-0">
                <input wire:model.live.debounce.250ms="search" type="text" placeholder="Search Here....">
            </div>
            
        </div>
        
        <div class="categorySlider">
            @foreach ($categories as $category)

            <div class="categoryItem" x-data="{active:false}" wire:click="updateSelectedCategories({{ $category->id }})">
                <a href="#" @click.prevent="active = !active" x-bind:class="active ? 'opacity-50' : ''" >


                    <img src="{{  $category->icon ? asset('storage/'.$category->icon) : asset('placeholder/categoryPlaceholder.png') }}" alt="">

                    <h5>{{ str($category->title)->headline() }}</h5>
                </a>
            </div>
            @endforeach

        </div>
    </div>


    <div class="orderArea mt-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="card-style p-3">
                    <div class="row">
                        @foreach ($foods as $food)
                        <div class="col-lg-3 mb-3">
                            <div class="card position-relative" x-data="{show: false}">
                                <span x-show="show" class="text-primary checked"><i
                                        class="lni lni-checkmark-circle"></i></span>
                                <a href="#" @click.prevent="show = !show;" x-bind:class=" show ? 'opacity-25' : ''">
                                    <img src="{{ asset('storage/'. $food->image) }}" alt="" class="card-img-top">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5>{{ $food->name }}</h5>
                                            <p class="text-dark"><b>{{ $food->price }} tk</b></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
               
            </div>
            <div class="col-lg-4">
                <div class="card-style">
                    <h5 class="mb-25">Order Summary</h5>

                    <div class="orderForm">
                        <div class="select-style-1">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <div class="select-position ">
                                        <select wire:model="customer" >
                                            <option value="walking">Walking Customer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">

                                    <a href="#0" class="main-btn primary-btn square-btn w-100  btn-hover btn-sm">
                                        <i class="lni lni-circle-plus"></i>
                                         Customer
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="items">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="product d-flex align-items-center">
                                    <img src="{{ asset('placeholder/foods/biriyani.jpg') }}" alt="" style="width: 80px;border-radius:15px;">
                                    <div class="ms-2">
                                        <h6 >Biriyani</h6> 
                                        <b style="font-size: 14px">350 tk</b>
                                    </div>
                                </div>
                                <div class="quantity">
                                    <input type="text">
                                </div>
                                <div class="totalPrice">
                                    <b>700tk</b>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>

                </div>
            </div>
        </div>
    </div>



</div>

@script
<script>
    let mouseDown = false;
    let startX, scrollLeft;
    const slider = document.querySelector('.categorySlider');
    
    const startDragging = (e) => {
    mouseDown = true;
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
    }
    
    const stopDragging = (e) => {
    mouseDown = false;
    }
    
    const move = (e) => {
    e.preventDefault();
    if(!mouseDown) { return; }
    const x = e.pageX - slider.offsetLeft;
    const scroll = x - startX;
    slider.scrollLeft = scrollLeft - scroll;
    }
    
    // Add the event listeners
    slider.addEventListener('mousemove', move, false);
    slider.addEventListener('mousedown', startDragging, false);
    slider.addEventListener('mouseup', stopDragging, false);
    slider.addEventListener('mouseleave', stopDragging, false);
</script>
@endscript

@assets
<style>
    .checked {
        position: absolute;
        font-size: 2rem;
        z-index: 9999;
        top: 10px;
        right: 20px;

    }
</style>
@endassets