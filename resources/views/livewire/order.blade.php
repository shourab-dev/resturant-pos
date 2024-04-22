<div>
    <div class="text-end btn-group ms-auto d-block">
        <a class="btn btn-sm btn-warning   " href="#">Print</a>
        <a wire:click.prevent="downloadPDF()"  class="btn btn-sm btn-success" href="#">Download</a>
    </div>
    <div class="invoice">
        <div class="heading text-center">
            <h4>{{ env('APP_NAME') }}</h4>
            <address>{{ env('RESTAURENT_ADDRESS') }}</address>
            <p>Phone: 01*******</p>
            <p><b>Retail Invoice</b></p> <br>
        </div>
        <p>Date: {{ Carbon\Carbon::parse(now())->format('d/m/Y') }}</p>
        <p>{{ $customerName->name }}</p>
        <p>Payment Method: Cash</p>

        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Amt</th>
                </tr>
            </thead>
            @php
            $total = 0;
            @endphp

            @foreach ($orderItems as $item)

            <tr>
                <td>{{ str()->headline($item['name']) }}</td>
                <td class="text-center">{{ $item['quantity'] }}</td>
                <td class="text-end">{{ $item['total_price'] }} tk</td>
            </tr>
            @php
            $total += $item['total_price'];
            @endphp
            @endforeach
            <tfoot>
                <tr>
                    <td><b>Total</b></td>

                    <td colspan="2" class="text-end">{{ $total }} tk</td>
                </tr>
            </tfoot>
        </table>
    </div>












</div>