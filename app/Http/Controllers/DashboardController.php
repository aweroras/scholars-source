<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;


class DashboardController extends Controller



{

    public function graphs()
    {
        $products = Product::all();
        $productNames = $products->pluck('name');
        $productStocks = $products->pluck('stock');

        $chart = new Chart;

        $chart->labels($productNames->toArray());
        $chart->dataset('Product Stocks', 'pie', $productStocks->toArray())
              ->backgroundColor([
                  '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
              ]);

        return view('admin.dashboard.index', compact('chart'));
    }

}
