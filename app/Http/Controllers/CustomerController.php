<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Retrieve latest 3 products with non-zero or non-null stock
        $products = Product::whereNotNull('stock')->where('stock', '>', 0)
            ->latest('created_at')->take(3)->get();

        return view('customer.index', ['products' => $products]);
    }

    
    public function search(Request $request)
    {
        $searchQuery = $request->input('search');

        if (!$searchQuery) {
            // If no search query is provided, redirect back to the index page
            return redirect()->route('customer.index');
        }

        // Filter out products with non-zero or non-null stock
        $searchResults = Product::whereNotNull('stock')->where('stock', '>', 0)
            ->where('name', 'like', '%' . $searchQuery . '%')
            ->orWhere('price', 'like', '%' . $searchQuery . '%')
            ->orWhere('category', 'like', '%' . $searchQuery . '%')
            ->latest('created_at')
            ->get();

        // Pass the filtered search results to the view
        return view('customer.shop', ['searchResults' => $searchResults, 'query' => $searchQuery]);
    }


    public function shop(Request $request)
    {
        // Retrieve the search query from the request
        $searchQuery = $request->input('search');
    
        // Query builder for products
        $queryBuilder = Product::whereNotNull('stock')->where('stock', '>', 0);
    
        // Check if a search query is provided
        if ($searchQuery) {
            // Filter products based on search query
            $queryBuilder->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%')
                      ->orWhere('price', 'like', '%' . $searchQuery . '%')
                      ->orWhere('category', 'like', '%' . $searchQuery . '%');
            });
        }
    
        // Paginate the results with 5 products per page
        $products = $queryBuilder->latest('created_at')->paginate(6);
    
        // Pass the products and search query to the view
        return view('customer.shop', ['products' => $products, 'searchResults' => $products, 'query' => $searchQuery]);
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
        //DB::table('carts')->where('id', $cart->id)->update(['quantity' => $cart->quantity + $quantity, 'created_at' => now()]);
        DB::table('carts')->where('customer_id',$customerId)->where('product_id', $productId)->update(['quantity' => $cart->quantity + $quantity, 'created_at' => now()]);
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

     // Calculate the total (excluding shipping)
        $cartTotal = 0;
        foreach ($cart as $item) {
        $cartTotal += $item->quantity * $item->price;
        }

        $shippingFee = 50; 

    return view('customer.cart', ['cart' => $cart, 'cartTotal' => $cartTotal, 'shippingFee' => $shippingFee]);

    // // Calculate the total
    // $cartTotal = 0;

    // foreach ($cart as $item) {
    //     $cartTotal += $item->quantity * $item->price;
    // }

    // return view('customer.cart', ['cart' => $cart, 'cartTotal' => $cartTotal]);
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
    $cart = Cart::where('product_id', $product_id)->delete();


    return redirect()->route('customer.cart')->with('success', 'Product removed from cart successfully!');
}




public function checkout()
    {
        $customerId = auth()->id();
        $cartTotal = 0; // Initialize cartTotal
        $subTotal = 0;  // Initialize subtotal
    
        // Fetch cart items with eager loading
        $cart = Cart::where('customer_id', $customerId)
            ->with('product') // Eager load the product relationship
            ->get();
    
        // Calculate the subtotal (excluding shipping)
        foreach ($cart as $item) {
            // Access the product price from the relationship
            $price = $item->product->price;
            // Calculate subtotal for each item
            $subTotal += $item->quantity * $price;
        }
    
        // Calculate the total (including shipping)
        $shippingFee = 50;
        $totalAmount = $cartTotal + $shippingFee; // Assuming cartTotal includes additional costs
    
        return view('customer.checkout', [
            'cart' => $cart,
            'cartTotal' => $cartTotal, // Assuming cartTotal includes additional costs
            'subTotal' => $subTotal,  // Pass the calculated subtotal
            'shippingFee' => $shippingFee,
            'totalAmount' => $totalAmount,
        ]);
    }
    
//      $customerId = auth()->id();
// $cartTotal = 0;
   
//   // Fetch cart items with eager loading
//   $cart = Cart::where('customer_id', $customerId)
//   ->with('product') // Eager load the product relationship
//   ->get();


//       // Calculate the total (excluding shipping)
//       foreach ($cart as $item) {
//       $cartTotal += $item->quantity * $item->price;
//       }

//     // Total amount including shipping
//     $shippingFee = 50;
    
//     $totalAmount = $cartTotal + $shippingFee;
//     return view('customer.checkout', ['cart' => $cart, 'cartTotal' => $cartTotal, 'shippingFee' => $shippingFee, 'totalAmount' => $totalAmount]);
//    // return view('customer.checkout', compact('cart'));

public function orderinfo()
{
    return view('customer.orderinfo');
}

    public function customerDetails()
    {
    
}

public function placeOrder(Request $request)
    {
        $user = auth()->user();

        // Validation (optional)
        $this->validate($request, [
            'customerName' => 'required',
            'phoneNumber' => 'required',
            'shippingAddress' => 'required',
            'product_id' => 'required|array', // Ensure product_id is an array
            'quantity' => 'required|array|size:product_id', // Ensure quantity matches product_id count
        ]);

        // Create a new order
        $order = new Order;
        $order->user_id = $user->id;
        $order->customer_name = $request->customerName;
        $order->phone_number = $request->phoneNumber;
        $order->shipping_address = $request->shippingAddress;
        $order->status = 'pending'; // Or appropriate initial order status
        $order->save();

        // Process ordered products
        $productIds = $request->input('product_id');
        $quantities = $request->input('quantity');

        // Attach products to the order using a single loop
        for ($i = 0; $i < count($productIds); $i++) {
            $productId = $productIds[$i];
            $quantity = $quantities[$i];

            // Check if product exists (optional)
            $product = Product::find($productId);
            if (!$product) {
                // Handle case where product is not found (e.g., log error, continue with other products)
                continue;
            }

            $order->products()->attach($productId, ['quantity' => $quantity]);
        }

        // Order placed successfully (optional)
        return redirect()->route('customer.checkout')->with('success', 'Order placed successfully!');
    }
}




