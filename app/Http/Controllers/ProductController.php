<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Check if there's a search query in the request
        $searchQuery = $request->input('query');

        // If there's a search query, filter the products accordingly
        if ($searchQuery) {
            $products = Product::where('name', 'like', "%$searchQuery%")
                ->orWhere('category', 'like', "%$searchQuery%")
                ->orWhere('price', 'like', "%$searchQuery%")
                ->paginate(5);
        } else {
            // If there's no search query, retrieve all products paginated
            $products = Product::paginate(5);
        }

        return view('admin.products.index', compact('products'));
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
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
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
            'image' => implode(',', $imagePaths), // Implode array into a comma-separated string
        ]);
    
        // Redirect with a success message
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
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
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
}
