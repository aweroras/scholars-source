<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function home()
    {
        $products = Product::latest('created_at')->take(3)->get();
        return view('index', ['products' => $products]);
    }
    
    public function products(Request $request)
    {
        // Retrieve the search query from the request
        $searchQuery = $request->input('search');

        // If search query is provided, fetch search results
        if ($searchQuery) {
            // Query products based on search query
            $products = Product::where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('price', 'like', '%' . $searchQuery . '%')
                ->orWhere('category', 'like', '%' . $searchQuery . '%')
                ->latest('created_at')
                ->get();

            // Return view with search results
            return view('products', ['products' => $products, 'searchQuery' => $searchQuery]);
        }

        // If no search query, fetch categorized products
        // Group products by category
        $groupedProducts = Product::orderBy('category')
            ->get()
            ->groupBy('category');

        return view('products', ['groupedProducts' => $groupedProducts]);
    }

    public function about()
    {
        return view('about');
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search');

        if (!$searchQuery) {
            // If no search query is provided, redirect back to the index page
            return redirect()->route('home');
        }

        // Implement your search logic here and retrieve relevant results
        $searchResults = Product::where('name', 'like', '%' . $searchQuery . '%')
            ->orWhere('price', 'like', '%' . $searchQuery . '%')
            ->orWhere('category', 'like', '%' . $searchQuery . '%')
            ->latest('created_at')
            ->get();

        // Pass the results to the view
        return view('shop', ['searchResults' => $searchResults, 'query' => $searchQuery]);
    }

    public function viewOrders()
    {
        $orders = Order::all();
        return view('admin.orders.index', ['orders' => $orders]);
    }

    public function updateOrderStatusForm($orderId)
    {
        $order = Order::find($orderId);
        return view('admin.orders.update', ['order' => $order]);
    }

    public function updateOrderStatus(Request $request)
{
    $orderIds = $request->orderId;
    $order = Order::find($orderIds);
    $order->status = $request->status;
    $order->save();

    return redirect()->route('admin.orders.index', ['order' => $order->id])->with('success', 'Order status updated successfully!');
}
}
