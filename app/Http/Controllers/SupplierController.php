<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Supplier_Transaction;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    
    public function index()
    {
        $suppliers = Supplier::All();
        return view('admin.supplier.index',compact('suppliers'));
    }

    public function create()
    {
        return view('admin.supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
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

        $supplier = new Supplier([
            'supplier_name' => $request->name,
            'image' => implode(',', $imagePaths),
        ]);
        $supplier->save();

        return redirect()->route('supplier.index')->with('success', 'Supplier add successfully');
    }

    public function update($id)
    {
        $supplier = Supplier::where('id',$id)->first();
        
        return view('admin.supplier.update',compact('supplier'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $supplier = Supplier::find($id);
    
        if (!$supplier) {
            return redirect()->route('supplier.index')->with('error', 'Supplier not found.');
        }
    
        // Update supplier name
        $supplier->supplier_name = $request->name;
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePaths = [];
            foreach ($request->file('image') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('product_img'), $imageName);
                $imagePaths[] = 'product_img/' . $imageName;
            }
            // Merge new image paths with existing ones
            $supplier->image = implode(',', array_merge(explode(',', $supplier->image), $imagePaths));
        }
    
        $supplier->save();
    
        return redirect()->route('supplier.index')->with('success', 'Supplier updated successfully');
    }
    

    public function delete($id) {
        Supplier::destroy($id);
        return redirect()->route('supplier.index')->with('success', 'Delete Supplier Successfully');
    }
}
