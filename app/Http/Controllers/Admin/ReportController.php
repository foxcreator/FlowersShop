<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
    public function dailyReport()
    {
        $products = OrderProduct::whereDate('created_at', Carbon::now())->get();
        $totalSales = OrderProduct::whereDate('created_at', Carbon::now())->sum('price');
        $todayExpenses = 0;
        $totalOptSales = OrderProduct::whereDate('created_at', '2024-04-07')->sum('opt_price');
        $combinedProducts = $this->_getCombinedProducts($products);

        return view('admin.reports.index', compact([
            'todayExpenses',
            'totalSales',
            'totalOptSales',
            'combinedProducts'
        ]));
    }
    public function monthlyReport(Request $request)
    {
        $from = $request->from ? $request->from : Carbon::now()->subMonth();
        $to = $request->to ? $request->to : Carbon::now();
        $products = OrderProduct::whereBetween('created_at', [$from, $to])->get();
        $totalSales = OrderProduct::whereBetween('created_at', [$from, $to])->sum('price');
        $todayExpenses = 0;
        $totalOptSales = OrderProduct::whereBetween('created_at', [$from, $to])->sum('opt_price');
        $combinedProducts = $this->_getCombinedProducts($products);

        return view('admin.reports.monthly', compact([
            'todayExpenses',
            'totalSales',
            'totalOptSales',
            'combinedProducts',
            'to',
            'from'
        ]));
    }

    protected function _getCombinedProducts($products)
    {
        $groupedProducts = $products->groupBy('product_id');

        $combinedProducts = $groupedProducts->map(function ($group) {
            $firstProduct = $group->first();
            $totalQuantity = $group->sum('quantity');
            $totalSalesPrice = $group->sum(function ($product) {
                return $product->quantity * $product->price;
            });
            $totalWholesalePrice = $group->sum(function ($product) {
                return $product->quantity * $product->opt_price;
            });

            $firstProduct->quantity = $totalQuantity;
            $firstProduct->total_sales_price = $totalSalesPrice;
            $firstProduct->total_opt_price = $totalWholesalePrice;

            return $firstProduct;
        })->values();

        return $combinedProducts;
    }

    public function downloadSalesReport()
    {
        $products = OrderProduct::all();

        $totalSales = OrderProduct::whereDate('created_at', '2024-04-07')->sum('price');
        $totalOptSales = OrderProduct::whereDate('created_at', '2024-04-07')->sum('opt_price');
        $combinedProducts = $this->_getCombinedProducts($products);

        $filename = "sales_report_" . date('Y-m-d') . ".csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['Наименование', 'Текущая цена (розница) грн', 'Текущая оптовая цена (грн)', 'Продано(шт)', 'Остаток(шт)', 'Сумма продаж (грн)', 'Валовая прибыль (грн)']);

        foreach ($combinedProducts as $product) {
            fputcsv($handle, [
                $product->product->title_ru,
                $product->product->price,
                $product->product->opt_price,
                $product->quantity,
                $product->product->quantity,
                $product->total_sales_price,
                $product->total_sales_price - $product->total_opt_price
            ]);
        }

        fputcsv($handle, ['Общая сумма продаж', '', '', '', '', '', $totalSales]);
        fputcsv($handle, ['Чистая прибыль', '', '', '', '', '', $totalOptSales]);
        fclose($handle);

        $headers = [
            'Content-Type' => 'text/csv',
        ];

        return Response::download($filename, $filename, $headers)->deleteFileAfterSend(true);
    }
}
