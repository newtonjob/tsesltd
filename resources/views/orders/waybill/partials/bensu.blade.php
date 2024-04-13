<style>
    /**
    TODO: Work on this layout UI
     */
    body {
        font-family: 'Poppins', sans-serif;
    }

    p {
        font-size: 12px;
    }

    .table_holder {
        width: 100%;
    }

    table {
        font-size: 12px;
        background: #eaebec;
        margin: auto;
        border: #999 1px solid;
        width: 100%;
    }

    table th {
        padding: 7px;
        border-top: 1px solid #fafafa;
        border-bottom: 1px solid #e0e0e0;
        text-align: left;
        background: #27a3ed;
        text-transform: uppercase;
        color: white;
    }

    table td {
        padding: 7px;
        border-top: 1px solid #ffffff;
        border-bottom: 1px solid #999;
        border-left: 1px solid #999;
        background: #fff;
    }

    #sheet {
        background-color: white;
        width: 100%;
        margin: 1em auto;
    }

</style>

<div id="sheet">
    <table align="center" style="background:none; border:none; margin: auto;">
        <tr style="background:none; border:none; ">
            <td style="background:none; border:none; width: 15%">
                <img src="{{ cloudinary_url('bensu/logo/favicon.jpg') }}" height="70"/>
            </td>
            <td style="background:none; border:none; text-align: center">
                <h1>BENSU</h1>
                <p>YOUR NO. 1 ELECTRONICS SHOP</p>
                Website: <a href="{{ config('app.url') }}">{{ config('app.url') }}</a> |
                E-mail: <a href="mailto:info@bensultd.com">info@bensultd.com</a>
            </td>
            <td style="background:none; border:none;"></td>
        </tr>
    </table>
    <div style="text-align:center;">
        <h3 style="border: 2px solid #2f56c5; padding: 5px">CUSTOMER WAYBILL</h3>
    </div>
    <br>
    <table align="center" style="background:none; border:none; margin: auto;">
        <tr style="background:none; border:none; ">
            <td style="background:none; border:none;">
                <p><b>Bensu Headquarters</b><br>10B PRIME ROSE AVENUE,<br>IKOTA GRA.<br>IKOTA, LAGOS</p>
            </td>
            <td style="background:none; border:none; text-align: center; width: 30%;"></td>
            <td style="background:none; border:none;">
                <p>Date: {{ $order->created_at->format('d M, Y') }}<br>Invoice No: <b style="color: #0e5e01">{{ $order->id }}</b></p>
            </td>
        </tr>
    </table>
    <h1 style="text-align: right;">
        @if($order->isPaid())
            <span style="color: green">PAID</span>
        @endif
    </h1>
    <div class="table_holder">
        <table class="table" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th>Product</th>
                <th class="quantity" style="text-align: right">Quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($order->products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td class="quantity" style="text-align: right">{{ $product->pivot->quantity }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <hr>
    <br>
    <p><b>Please contact us for more information about payment options.</b></p>
    <p><b>Thank you for your patronage.</b></p>

    <table class="table" cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th style="text-align: center" colspan="2">REMITTANCE</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Invoice No:</td>
            <td><b style="color: #0e5e01">#{{ $order->id }}</b></td>
        </tr>
        <tr>
            <td>Customer Information:</td>
            <td>
                {{ $order->user->name }}
                <span style='color: green'>|</span>
                {{ $order->user->email}}
                <span style='color: green'>|</span>
                {{ $order->user->phone }}
            </td>
        </tr>
        <tr>
            <td>Customer Address:</td>
            <td>{{ $order->delivery_address ?? '--' }}</td>
        </tr>
        <tr>
            <td>Date:</td>
            <td>{{ $order->created_at->format('d M, Y') }}</td>
        </tr>
        </tbody>
    </table>
    <br>
    <p>
        <b style="color: green">Special Order/Delivery Notes:</b>
        <br>
        @if($order->notes)
            <i>{{ $order->notes }}</i>
        @else
            --
        @endif
    </p>
    <br>
    <br>
    <p style="background-color: #0b63b6; padding: 3px"></p>
</div>
