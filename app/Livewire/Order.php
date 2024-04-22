<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Reactive;

class Order extends Component
{

    public $customerId;
    #[Reactive]
    public $orderItems;
    



    public function render()
    {
        $this->dispatch('resetFoods');
        return view('livewire.order',  ['customerName' => Customer::select('name')->find($this->customerId)]);
    }


    function downloadPDF()
    {




        $pdf = Pdf::loadView('components.utils.orderInvoice', [
            'orderItems' => $this->orderItems,
            'customerName' => Customer::select('name')->find($this->customerId)
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Order.pdf');
    }
}
