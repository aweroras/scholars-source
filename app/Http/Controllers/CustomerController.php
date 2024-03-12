<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    
        $products = Product::latest('created_at')->take(3)->get();
    

    return view('customer.index', ['products' => $products]);
    }
public function search(Request $request)
{
    $searchQuery = $request->input('search');

    if (!$searchQuery) {
        // If no search query is provided, redirect back to the index page
        return redirect()->route('customer.index');
    }

    // Implement your search logic here and retrieve relevant results
    $searchResults = Product::where('name', 'like', '%' . $searchQuery . '%')
        ->orWhere('price', 'like', '%' . $searchQuery . '%')
        ->orWhere('category', 'like', '%' . $searchQuery . '%')
        ->latest('created_at')
        ->get();

    // Pass the results to the view
    return view('customer.shop', ['searchResults' => $searchResults, 'query' => $searchQuery]);
}


public function shop(Request $request)
{
    // Retrieve the search query from the request
    $searchQuery = $request->input('search');

    // Check if a search query is provided
    if ($searchQuery) {
        // Implement your search logic here and retrieve relevant results
        $products = Product::where('name', 'like', '%' . $searchQuery . '%')
            ->orWhere('price', 'like', '%' . $searchQuery . '%')
            ->orWhere('category', 'like', '%' . $searchQuery . '%')
            ->latest('created_at')
            ->get();
    } else {
        // If no search query, retrieve the latest 5 products
        $products = Product::latest('created_at')->take(5)->get();
    }

    // Pass the products and search query to the view
    return view('customer.shop', ['product' => $products, 'searchResults' => $products, 'query' => $searchQuery]);
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

public function addToCart(Request $request, $productId)
{
    $product = Product::find($productId);

    // Get the quantity from the input box (default to 1 if not provided or invalid)
    $quantity = $request->input('quantity', 1);

    // Get the authenticated user's ID, assuming you have user authentication
    $customerId = auth()->id();

    // Check if the product is already in the cart
    if ($cart = DB::table('carts')->where('customer_id', $customerId)->where('product_id', $productId)->first()) {
        // If yes, update the quantity
        DB::table('carts')->where('id', $cart->id)->update(['quantity' => $cart->quantity + $quantity, 'created_at' => now()]);
    } else {
        // If no, insert the product into the cart
        $cartId = DB::table('carts')->insertGetId([
            'customer_id' => $customerId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'created_at' => now(),
        ]);

        // If you need the cart ID for any further processing, you can use $cartId
    }

    // Redirect back to the user.product page with a success message
    return back();
}

public function cart(Request $request)
{
    // Get the authenticated user's ID, assuming you have user authentication
    $customerId = auth()->id();

    // Fetch cart items from the database based on the user's ID
    $cart = DB::table('carts')
        ->where('customer_id', $customerId)
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->select('carts.customer_id', 'products.id as product_id', 'products.name', 'products.image', 'products.price', 'carts.quantity')
        ->get();

    // Calculate the total
    $cartTotal = 0;

    foreach ($cart as $item) {
        $cartTotal += $item->quantity * $item->price;
    }

    return view('customer.cart', ['cart' => $cart, 'cartTotal' => $cartTotal]);
}


public function updateQuantity(Request $request, $customer_id, $product_id)
{
    $quantity = $request->input('action') === 'increment' ? 1 : -1;

    // Update the quantity and set the updated_at column to the current timestamp
    DB::table('carts')
        ->where('customer_id', $customer_id)
        ->where('product_id', $product_id)
        ->update(['quantity' => DB::raw('quantity + ' . $quantity), 'updated_at' => now()]);

    return redirect()->route('customer.cart');
}


public function removeFromCart(Request $request, $product_id)
{
    $customerId = auth()->id();

    // Fetch cart items from the database based on the user's ID
    $cart = DB::table('carts')
        ->where('customer_id', $customerId)
        ->where('product_id', $product_id)
        ->delete();

    return redirect()->route('customer.cart')->with('success', 'Product removed from cart successfully!');
}

}
