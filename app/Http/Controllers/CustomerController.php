<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::latest('created_at')->take(3)->get();

        return view('customer.index', ['product' => $product]);
    }

    public function shop(Request $request){
        $product = Product::latest('created_at')->take(5)->get();

        return view('customer.shop', ['product' => $product]);
    }


public function details($id)
{
    // Fetch the product details based on the $id
    $product = Product::find($id);

    // Return the view with the product details
    return view('customer.details', compact('product'));
}

public function showProductDetails($productId)
{
    // Fetch the main product details
    $product = Product::find($productId);

    // Fetch similar products based on the category (you might need to adjust this logic)
    $similarProducts = Product::where('category', $product->category)
        ->where('id', '!=', $product->id)
        ->take(3) // Adjust the number of similar products to display
        ->get();

    return view('customer.details', compact('product', 'similarProducts'));
}
}
