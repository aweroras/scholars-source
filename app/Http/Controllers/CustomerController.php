<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::all();

        return view('user.index', ['product' => $product]);
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


    public function showCart(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        return view('user.cart', ['cart' => $cart]);
    }

    public function cart(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        // Calculate the total
        $cartTotal = array_sum(array_column($cart, 'price', 'quantity'));

        return view('user.cart', ['cart' => $cart, 'cartTotal' => $cartTotal]);
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

        return redirect()->route('user.cart')->with('success', 'Product removed from cart successfully!');
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

    return redirect()->route('user.cart')->with('success', 'Quantity updated successfully!');
}

    public function viewProduct($id){
        $product = Product::find($id);

        // Get related products based on the category of the viewed product
    $relatedProducts = Product::where('category', $product->category)
    ->where('id', '<>', $product->id) // Exclude the viewed product itself
    ->take(4) // Adjust the number of related products as needed
    ->get();

return view('user.product', ['product' => $product, 'relatedProducts' => $relatedProducts]);
}

public function search(Request $request)
{
    $query = $request->input('query');

    // Perform the search logic based on the product name or category
    $products = Product::where('name', 'like', '%' . $query . '%')
                       // Add additional conditions for category filtering, if needed
                       ->get();

    return view('user.search-query', compact('products', 'query'));
}
}
