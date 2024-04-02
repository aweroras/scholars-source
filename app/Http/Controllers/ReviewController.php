<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Models\Order;

class ReviewController extends Controller
{
/* public function index()
{
    // Get all reviews (or filter based on parameters)
    $reviews = Review::with('customer', 'order')->get(); // Eager load related models

    return view('reviews.index', compact('reviews'));
} */

public function index()
{
    $customer = auth()->user()->customer;
    $orders = $customer->orders()->with('products')->get();

    return view('reviews.index', ['orders' => $orders]);
}

public function create(Request $request)
{
    Log::info($request->all());
    $product = Product::find($request->product);
    $order = Order::find($request->order);

    return view('reviews.create', ['product' => $product, 'order' => $order]);
}

public function edit(Request $request, Review $review)
{
    
    $product = Product::find($request->product);
    $order = Order::find($request->order);

    return view('reviews.edit', ['product' => $product, 'order' => $order]);
}

public function update(Request $request, $id)
{
    // Validate user input (rating and content)
    $this->validate($request, [
        'rate' => 'required|integer|min:1|max:10',
        'comment' => 'required|string|min:3',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $review = Review::find($id);

    // Fill model properties (avoid mass assignment for security)
    $review->rate = $request->rate;
    $review->comment = $request->comment;
    $review->order_id = $request->order;
    $review->product_id = $request->product;
    $review->customer_id = $request->customer;

    // Handle image upload (optional)
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storePubliclyAs('uploads/reviews', $imageName);
        $review->image = $imageName;
    }

    // Save the review to the database
    $review->save();

    // Redirect or show success message
    return redirect()->route('reviews.reviewslist')->with('success', 'Review updated successfully!');
}

public function store(Request $request)
{
    Log::info($request->all());
    // Validate user input (rating and content)
    $this->validate($request, [
        'rate' => 'required|integer|min:1|max:10',
        'comment' => 'required|string|min:3',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);
    $customerid = auth()->user()->customer->id;
    $review = new Review;

  // Fill model properties (avoid mass assignment for security)
  $review->rate = $request->rate;
  $review->comment = $request->comment;
  $review->order_id = $request->order;
  $review->product_id = $request->product;
  $review->customer_id = $customerid;
  $review->created_at = now();

  // Handle image upload (optional)
  if ($request->hasFile('image')) {
      $image = $request->file('image');
      $imageName = time() . '.' . $image->getClientOriginalExtension();
      $image->storePubliclyAs('uploads/reviews', $imageName);
      $review->image = $imageName;
  }

  // Save the review to the database
  $review->save();

  // Redirect or show success message
  return redirect()->route('reviews.index')->with('success', 'Review submitted successfully!');
}

public function reviewedProducts()
{
    $customer = auth()->user()->customer;
    $reviews = $customer->reviews; // Assuming 'reviews' is the relationship name in your Customer model

    $reviewedProducts = $reviews->map(function ($review) {
        return [
            'product' => $review->product, // Assuming 'product' is the relationship name in your Review model
            'review' => $review
        ];
    });

    return view('reviews.reviewlist', ['reviewedProducts' => $reviewedProducts]);
}
}
