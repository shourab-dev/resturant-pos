<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ORDER Invoice</title>
</head>

<body style="font-family: Arial, Helvetica, sans-serif">

    <center>

        <table width="100%">
            <tr>
                <td>
                    <div style="text-align: center">
                        <h4>{{ env('APP_NAME') }}</h4>
                        <address>{{ env('RESTAURENT_ADDRESS') }}</address>
                        <p>Phone: 01*******</p>
                        <p><b>Retail Invoice</b></p> <br>
                    </div>
                    <p>Date: {{ Carbon\Carbon::parse(now())->format('d/m/Y') }}</p>
                    <p>{{ $customerName['name'] }}</p>
                    <p>Payment Method: Cash</p>
                </td>
            </tr>
        </table>
        <table width="100%" style="border: 1px solid #ccc;">
            <thead>
                <tr>
                    <th style="border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">Item</th>
                    <th style="border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;" align="center">Qty</th>
                    <th style="border-bottom: 1px solid #ccc;" align="center">Amt</th>
                </tr>
            </thead>
            @php
            $total = 0;
            @endphp

            @foreach ($orderItems as $item)

            <tr style="border-bottom: 1px solid #ccc;">
                <td align="center" style="border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;">{{
                    str()->headline($item['name']) }}</td>
                <td style="border-bottom: 1px solid #ccc;border-right: 1px solid #ccc;" align="center">{{
                    $item['quantity'] }}</td>
                <td style="border-bottom: 1px solid #ccc;" align="center">{{ $item['total_price'] }} tk</td>
            </tr>
            @php
            $total += $item['total_price'];
            @endphp
            @endforeach
            <tfoot>
                <tr align="center">
                    <td colspan="2" style="border-right: 1px solid #ccc;"><b>Total</b></td>

                    <td style="border-right: 1px solid #ccc;"><b>{{ $total }} tk</b></td>
                </tr>
            </tfoot>
        </table>
    </center>


</body>

</html>