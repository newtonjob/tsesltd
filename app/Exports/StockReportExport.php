<?php

namespace App\Exports;

use App\Models\OrderProduct;
use App\Models\Stock;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

class StockReportExport extends StringValueBinder implements FromCollection, WithHeadings, Responsable
{
    use Exportable;

    public string $fileName = 'BensuStockReport.csv';

    public function collection(): Collection
    {
        return Stock::with('location', 'product')
            ->unless(blank(request('location_id')))
            ->whereIn('location_id', request('location_id'))
            ->get()
            ->map(fn ($stock) => [
                $stock->location->name,
                $stock->product->name,
                $stock->product->model_no,
                $stock->product->subCategory?->category?->name,
                $stock->product->subCategory?->name,
                $stock->product->brand?->name,
                $stock->product->price,
                "$stock->quantity",
                $stock->product->price * $stock->quantity,
                "{$stock->product->discount}",
            ]);
    }

    public function headings(): array
    {
        return [
            'Location',
            'Product',
            'Model Number',
            'Category',
            'Sub Category',
            'Brand',
            'Price',
            'Quantity',
            'Stock Value',
            'Discount'
        ];
    }
}
