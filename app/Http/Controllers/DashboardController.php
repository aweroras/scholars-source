<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order; 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function graphs()
    {
        
        $pendingUsersCount = User::where('status', 'Pending')->count();

        $verifiedUsersCount = User::where('status', 'Verified')
        ->where('roles', 'not like', '%admin%')
        ->count();

        
        $deactivatedUsersCount = User::where('status', 'Deactivated')->count();

        
        $usersPerWeek = User::whereNotIn('roles', ['Admin'])
            ->selectRaw('COUNT(*) as count, YEARWEEK(created_at) as week')
            ->groupBy('week')
            ->orderBy('week')
            ->get();

        $labels = [];
        $data = [];

        foreach ($usersPerWeek as $record) {
            $year = substr($record->week, 0, 4);
            $week = substr($record->week, 4);
            $weekStartDate = Carbon::now()->setISODate($year, $week)->startOfWeek();
            $labels[] = $weekStartDate->format('Y-m-d');
            $data[] = $record->count;
        }

        
        $quantitySoldPerProduct = DB::table('order_product')
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(order_product.quantity) as quantity_sold'))
            ->groupBy('products.name')
            ->get();

        
        $quantitySoldLabels = $quantitySoldPerProduct->pluck('name');
        $quantitySoldData = $quantitySoldPerProduct->pluck('quantity_sold');

        
        $products = Product::select('name', 'stock')->get();

        
        $pieLabels = $products->pluck('name');
        $pieData = $products->pluck('stock');

        return view('admin.dashboard.index', compact('labels', 'data', 'pendingUsersCount', 'verifiedUsersCount', 'deactivatedUsersCount', 'pieLabels', 'pieData', 'quantitySoldLabels', 'quantitySoldData'));
    }
}
