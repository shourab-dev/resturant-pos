<div>
    <div class="card-style mt-5">
        <div class="searchBar  ">
            <div class="input-style-1 mb-0">
                <input wire:model.live.debounce.250ms="search" type="text" placeholder="Search Here....">
            </div>

        </div>

        <div class="categorySlider">
            @foreach ($categories as $category)

            <div class="categoryItem" x-data="{active:false}"
                wire:click="updateSelectedCategories({{ $category->id }})">
                <a href="#" @click.prevent="active = !active" x-bind:class="active ? 'opacity-50' : ''">


                    <img src="{{  $category->icon ? asset('storage/'.$category->icon) : asset('placeholder/categoryPlaceholder.png') }}"
                        alt="" style="width: 120px;height:120px;object-fit:cover;object-position:center;">

                    <h5>{{ str($category->title)->headline() }}</h5>
                </a>
            </div>
            @endforeach

        </div>
    </div>


    <div class="orderArea mt-5">
        <div class="row">
            <div class="col-lg-7 order-2 order-lg-1">
                <div class="card-style p-3">
                    <div class="row">
                        @foreach ($foods as $food)
                        <div class="col-lg-4 col-6 mb-3" wire:key="{{ $food->id }}">
                            <div class="card position-relative" x-data="{show: false, productId: {{ $food->id }}}"
                                x-on:remove-selected-food.window="$event.detail[0].id == productId ? show = false : null;">
                                <span x-show="show && productId == {{ $food->id }}" class="text-primary checked"><i
                                        class="lni lni-checkmark-circle"></i>
                                </span>
                                <a href="#" wire:click="selectedFoodsItems({{ $food }})"
                                    @click.prevent="productId == {{ $food->id }} ? show = !show : false;"
                                    x-bind:class=" show && productId == {{ $food->id }} ? 'opacity-25' : ''">
                                    <img src="{{ asset('storage/'. $food->image) }}" alt="" class="card-img-top"
                                        style="width: 274px;max-width:100%;height:184px;object-fit:cover;object-position:center;">
                                    <div class="card-body">
                                        <div class="d-lg-flex justify-content-between align-items-center">
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

            <div class="col-lg-5 order-1 order-lg-2 mb-5 orderPanel" x-ref="orderPanelRef">
                <div class="card-style">
                    <h5 class="mb-25">Order Summary</h5>

                    <div class="orderForm">
                        <div class="select-style-1">
                            <div class="row align-items-center">
                                <div class="col-xl-8">
                                    <div class="select-position ">
                                        <select wire:model="selectedCustomer">
                                            @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 my-3">

                                    <a href="#0" class="main-btn primary-btn square-btn w-100  btn-hover btn-sm">
                                        <i class="lni lni-circle-plus"></i>
                                        Customer
                                    </a>
                                </div>

                            </div>
                        </div>

                        <div class="order_wrapper_list">
                            @foreach ($selectedFoods as $key=>$selectedFood)
                            <div class="items my-3" x-data="{price: {{ $selectedFood['price'] }}, quantity:1}"
                                wire:key="{{ $selectedFood['id'] }}">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-8">
                                        <div class="product d-flex align-items-center mb-2">
                                            <img src="{{ asset('storage/'. $selectedFood['image']) }}" alt=""
                                                style="width: 80px;border-radius:15px;object-fit:cover;height:80px;">
                                            <div class="ms-2">
                                                <h6>{{ str($selectedFood['name'])->headline() }}</h6>
                                                <b style="font-size: 14px">{{ $selectedFood['price'] }} tk</b>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="quantity">
                                                <input type="number" min="1" x-model="quantity" class="text-center "
                                                    placeholder="quantity"
                                                    x-on:blur="$event.target.value > 0 ? quantity = $event.target.value : ($event.target.value == 0 ? quantity = 1 : quantity = Math.abs($event.target.value)) ; $wire.updateFoodQuantity({{ $key }}, quantity);"
                                                    x-on:keyup="$event.target.value > 0 ? quantity = $event.target.value : false;$wire.updateFoodQuantity({{ $key }}, quantity);"
                                                    style="height: 45px;border:1px solid #ccc;width:80px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="itemPrice d-flex align-items-center">
                                            <b><span x-text="Math.abs(price * quantity)" x-ref="calPrice"></span>tk</b>
                                            <a href="#"
                                                wire:click.prevent="removeFoodItem({{ json_encode($selectedFood) }})"
                                                class="text-danger ms-2"><i class="lni lni-cross-circle"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <hr>
                            @if (count($selectedFoods) > 0)
                            <div class="row align-items-center">
                                <div class="col-md">
                                    <h5>Total Price: {{ $totalPrice }} tk</h5>
                                </div>
                                <div class="col-md text-start text-md-end mt-3 mt-lg-0">
                                    <a href="#" wire:click.prevent="placeOrders();$dispatch('open-modal', {name: 'order-confirm'})"
                                        class="main-btn success-btn square-btn btn-sm  btn-hover btn-sm">
                                        Place Order

                                    </a>
                                </div>
                            </div>
                            <x-modal title="Order Invoice" name="order-confirm" width="600px">
                                @slot('modalSlot')
                                <livewire:order customerId="{{$selectedCustomer}}"  :orderItems="$selectedFoods"/>
                                @endslot
                            </x-modal>
                            @endif
                        </div>
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



    //*  order panel fixed
   /**@argument
    * let orderPanel = $('.orderPanel')
    let orderPanelOffset = orderPanel.offset().top
    
    function fixOrderPanel() {
    let scrTop = $(window).scrollTop()
    console.log(scrTop, orderPanelOffset,scrTop > orderPanelOffset);
    if(scrTop > orderPanelOffset){
    orderPanel.addClass('fixed')
    } else{
    orderPanel.removeClass('fixed')
    }
    }
    
    
    
    window.addEventListener('scroll', fixOrderPanel)
   */
    
    


</script>
@endscript

@assets
<style>
    .checked {
        position: absolute;
        font-size: 2rem;
        z-index: 1;
        top: 10px;
        right: 20px;

    }

    .orderPanel {
        max-height: calc(100vh - 90px);
        overflow-y: auto;


    }

    @media (min-width: 992px) {


        .orderPanel.fixed {
            position: fixed;
            top: 90px;
            right: 20px;
            z-index: 999;
            width: fit-content;
        }
    }
</style>
@endassets