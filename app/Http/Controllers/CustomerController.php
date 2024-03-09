<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

public function addToCart(Request $request, $productId)
{
    $product = Product::find($productId);

    // Get the quantity from the input box (default to 1 if not provided or invalid)
    $quantity = $request->input('quantity', 1);

    // Get the current cart from the session
    $cart = $request->session()->get('cart', []);

    // Check if the product is already in the cart
    if (array_key_exists($product->id, $cart)) {
        // If yes, increment the quantity
        $cart[$product->id]['quantity'] += $quantity;
    } else {
        // If no, add the product to the cart
        $cart[$product->id] = [
            'name' => $product->name,
            'image' => $product->image,
            'price' => $product->price,
            'quantity' => $quantity,
        ];
    }

    // Store the updated cart back in the session
    $request->session()->put('cart', $cart);

    // Redirect back to the user.product page with a success message
    return back();
}
public function cart(Request $request)
{
    $cart = $request->session()->get('cart', []);

    // Calculate the total
    $cartTotal = 0;

    foreach ($cart as $item) {
        $cartTotal += $item['quantity'] * $item['price'];
    }

    return view('customer.cart', ['cart' => $cart, 'cartTotal' => $cartTotal]);
}

public function updateQuantity(Request $request, $key)
{
    $cart = $request->session()->get('cart', []);

    if (isset($cart[$key])) {
        if ($request->input('action') === 'increment') {
            $cart[$key]['quantity']++;
        } elseif ($request->input('action') === 'decrement' && $cart[$key]['quantity'] > 1) {
            $cart[$key]['quantity']--;
        }

        $request->session()->put('cart', $cart);
    }

    return redirect()->route('customer.cart');
}
public function removeFromCart(Request $request, $key)
{
    $cart = $request->session()->get('cart', []);

    // Check if the key exists in the cart array
    if (isset($cart[$key])) {
        // Remove the item from the cart using the key
        unset($cart[$key]);

        // Update the cart in the session
        $request->session()->put('cart', $cart);
    }

    return redirect()->route('customer.cart')->with('success', 'Product removed from cart successfully!');
}
}
