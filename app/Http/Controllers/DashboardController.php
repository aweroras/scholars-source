<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function userchart()
    {
        $usersPerWeek = User::whereNotIn('roles', ['Admin'])
                        ->selectRaw('COUNT(*) as count, YEARWEEK(created_at) as week')
                        ->groupBy('week')
                        ->orderBy('week')
                        ->get();

    $labels = [];
    $data = [];

    foreach ($usersPerWeek as $record) {
        // Parse year and week
        $year = substr($record->week, 0, 4);
        $week = substr($record->week, 4);
        // Create Carbon instance for the start of the week
        $weekStartDate = Carbon::now()->setISODate($year, $week)->startOfWeek();
        $labels[] = $weekStartDate->format('Y-m-d');
        $data[] = $record->count;
    }
    
    
        $customTicks = [0, 10, 50, 100];
        return view('admin.dashboard.userchart', compact('labels', 'data', 'customTicks'));

    }
    
}
