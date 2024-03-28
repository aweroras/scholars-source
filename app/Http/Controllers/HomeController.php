<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
    
    public function products()
    {
        $products = Product::orderBy('category')->latest('created_at')->take(5)->get();
        return view('products', ['products' => $products]);
    }

    public function about()
    {
        return view('about');
    }
}
