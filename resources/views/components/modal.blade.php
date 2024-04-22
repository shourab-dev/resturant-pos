@props(['title','width', 'name'])
<div style="position: fixed; inset:0;z-index:99999999999999999999999;display:none" x-data="{ show: false, name: '{{ $name }}' }"
    x-transition
    x-show="show" x-on:open-modal.window="show = ($event.detail.name === name )" x-on:close-modal.window="show = false"
    x-on:keydown.escape.window="$dispatch('closeModal');show = false;">
    <div style="position: fixed; inset: 0; height: 100vh;background-color:rgba(0,0,0,0.5)" x-on:click="show = false">
    </div>
    <div  class=" modalContent"
        style="background: white;padding:30px;border-radius:10px;transform:translate(-50%,-50%);top:50%;left:50%;position:fixed;width:{{ $width ?? '450px' }};max-width: 100%;max-height: 95vh;overflow-y:auto;">

        <div class="d-flex justify-content-{{ isset($title) ? 'between' : " end" }}">
            @if (isset($title))
            <h5 class="mb-25">{{ $title }}</h5>
            @endif

            <span class="text-danger" x-on:click="show = false;$dispatch('closeModal')" style="cursor:pointer"><i
                    class="lni lni-cross-circle"></i></span>
        </div>


        {{ $modalSlot }}
    </div>
</div>