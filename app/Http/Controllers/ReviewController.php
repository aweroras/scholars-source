<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
public function index()
{
    // Get all reviews (or filter based on parameters)
    $reviews = Review::with('customer', 'product')->get(); // Eager load related models

    return view('reviews.index', compact('reviews'));
}

public function create()
{
    return view('reviews.create');
}

public function store(Request $request)
{
    // Validate user input (rating and content)
    $this->validate($request, [
        'rate' => 'required|integer|min:1|max:10',
        'comment' => 'required|string|min:3',
        'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $review = new Review;

  // Fill model properties (avoid mass assignment for security)
  $review->rate = $request->rate;
  $review->comment = $request->comment;

  // Handle image upload (optional)
  if ($request->hasFile('img_path')) {
      $image = $request->file('img_path');
      $imageName = time() . '.' . $image->getClientOriginalExtension();
      $image->storePubliclyAs('uploads/reviews', $imageName);
      $review->img_path = $imageName;
  }

  // Save the review to the database
  $review->save();

  // Redirect or show success message
  return redirect()->route('reviews.index')->with('success', 'Review submitted successfully!');
}

}
