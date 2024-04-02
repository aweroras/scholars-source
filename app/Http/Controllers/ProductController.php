<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class ProductController extends Controller
{
    public function index()
    {
        
        $products = Product::all();
        $softDeletedCount = Product::onlyTrashed()->count();
    
        return view('admin.products.index', compact('products', 'softDeletedCount'));
    }
    public function restoreAll()
    {
        Product::onlyTrashed()->restore();
    
        return redirect()->route('admin.products.index')->with('success', 'All soft-deleted products restored successfully.');
    }


    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:10120'

        ]);
    
        // Handle file upload for multiple images
        $imagePaths = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('product_img'), $imageName);
                $imagePaths[] = 'product_img/' . $imageName;
            }
        }
    
        // Create a new product with the validated data
        $newProduct = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'category' => $request->input('category'),
            'image' => implode(',', $imagePaths), 
        ]);
    
       
        return redirect(route('admin.products.index'))->with('success', 'You added a new product.');
    }
    

    public function edit(Product $product)
    {
        return view ('admin.products.edit', ['product' => $product]);
    }

    public function update(Product $product, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Handle file upload for multiple images
        $imagePaths = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('product_img'), $imageName);
                $imagePaths[] = 'product_img/' . $imageName;
            }
    
            // Delete old images
            foreach (explode(',', $product->image) as $oldImage) {
                if (file_exists(public_path($oldImage))) {
                    unlink(public_path($oldImage));
                }
            }
    
            $data['image'] = implode(',', $imagePaths);
        }
    
        $product->update($data);
    
        return redirect(route('admin.products.index'))->with('success', 'Product information updated.');
    }
    

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', "Product information deleted.");
    }


    public function reviews($id)
{
    $product = Product::find($id);
    $reviews = $product->reviews;

    $reviews = Review::whereHas('product', function ($query) use ($id) {
        $query->where('id', $id);
    })->get();

    return view('admin.products.reviews', compact('product', 'reviews'));
}
    
}
