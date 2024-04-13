<?php

namespace App\Http\Requests;

use App\Models\Location;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class ReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('manage-report');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function data()
    {
        $administrators = User::whereType('admin')->get();
        $locations      = Location::all();
        $products       = Product::all();
        $stock          = Stock::sum('quantity');
        $stockValue     = Stock::join('products', 'stock.product_id', 'products.id')->sum(DB::raw('price * quantity'));
        $todaySales     = OrderProduct::where('created_at', '>=', today())->sum(DB::raw('price * quantity'));
        $weekSales      = OrderProduct::where('created_at', '>=', now()->startOfWeek())->sum(DB::raw('price * quantity'));
        $monthSales     = OrderProduct::where('created_at', '>=', now()->startOfMonth())->sum(DB::raw('price * quantity'));
        $yearSales      = OrderProduct::where('created_at', '>=', now()->startOfYear())->sum(DB::raw('price * quantity'));
        $stockProfit    = $stockValue - Stock::join('products', 'stock.product_id', 'products.id')->sum(DB::raw('cost_price * quantity'));

        $todayProfit    = $todaySales - OrderProduct::where('order_product.created_at', '>=', today())
                ->join('products', 'product_id', '=', 'products.id')
                ->sum(DB::raw('cost_price * quantity'));

        $weekProfit = $weekSales - OrderProduct::where('order_product.created_at', '>=', now()->startOfWeek())
                ->join('products', 'product_id', '=', 'products.id')
                ->sum(DB::raw('cost_price * quantity'));

        $monthProfit = $monthSales - OrderProduct::where('order_product.created_at', '>=', now()->startOfMonth())
                ->join('products', 'product_id', '=', 'products.id')
                ->sum(DB::raw('cost_price * quantity'));

        $yearProfit = $yearSales - OrderProduct::where('order_product.created_at', '>=', now()->startOfYear())
                ->join('products', 'product_id', '=', 'products.id')
                ->sum(DB::raw('cost_price * quantity'));

        $incomeStatistics = Transaction::yearStats()->get()->keyBy('month_name')->map->total;

        return compact('administrators', 'locations', 'products', 'stock', 'stockValue', 'todaySales', 'weekSales', 'monthSales', 'yearSales', 'stockProfit', 'todayProfit', 'weekProfit', 'monthProfit', 'yearProfit', 'incomeStatistics');
    }
}
