<?php

namespace App\Exports;

use App\Models\OrderProduct;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesReportExport implements FromCollection, WithHeadings, Responsable
{
    use Exportable;

    public string $fileName = 'BensuSalesReport.csv';

    public function collection(): Collection
    {
        return OrderProduct::has('order')
            ->with('order', 'product')
            ->whereBetween('created_at', request()->only('from', 'to'))
            ->unless(blank(request('product_id')))
            ->whereIn('product_id', request('product_id'))
            ->unless(blank(request('user_id')))
            ->whereIn('created_by', request('user_id'))
            ->get()
            ->map(fn ($orderProduct) => [
                "#$orderProduct->order_id",
                $orderProduct->product->name,
                $orderProduct->quantity,
                $orderProduct->order->user->name,
                $orderProduct->order->user->email,
                $orderProduct->order->user->phone,
                $orderProduct->creator?->name,
                $orderProduct->created_at->toDayDateTimeString(),
            ]);
    }

    public function headings(): array
    {
        return [
            'Order',
            'Product',
            'Quantity Sold',
            'Customer',
            'Customer Email',
            'Customer Phone',
            'Sales Person',
            'Date'
        ];
    }
}
