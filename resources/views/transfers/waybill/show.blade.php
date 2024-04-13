<style>
    /**
    TODO: Work on this layout UI
     */

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
                <img src="{{ cloudinary_url('logo/favicon.png') }}" height="70"/>
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
        <h3 style="border: 2px solid #2f56c5; padding: 5px">INTER-BRANCH TRANSFER WAYBILL</h3>
    </div>
    <br>
    <table align="center" style="background:none; border:none; margin: auto;">
        <tr style="background:none; border:none; ">
            <td style="background:none; border:none;">
                <p><b>Bensu Headquarters</b><br>10B PRIME ROSE AVENUE,<br>IKOTA GRA.<br>IKOTA, LAGOS</p>
            </td>
            <td style="background:none; border:none; text-align: center; width: 30%;"></td>
            <td style="background:none; border:none;">
                <p>Date: {{ $transfer->created_at->format('d M, Y') }}<br>Transfer No: <b style="color: #0e5e01">{{ sprintf("%04d",$transfer->id) }}</b></p>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <h5>TRANSFER INFORMATION</h5>
    <div class="table_holder">
        <table class="table" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th>Product</th>
                <th>Location From</th>
                <th>Location To</th>
                <th style="text-align: right">Transferred Quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transfer->products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->pivot->from_location->name }}</td>
                    <td>{{ $product->pivot->to_location->name }}</td>
                    <td style="text-align: right">{{ $product->pivot->quantity }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"><b><i> Total Quantity Transferred</i></b></td>
                <td class="total" style="text-align: right"><b>{{ $transfer->products->sum('pivot.quantity') }}</b></td>
            </tr>
            </tbody>
        </table>
    </div>
    <br>
    <hr>
    <br>
    <p style="background-color: #0b63b6; padding: 3px"></p>

</div>
