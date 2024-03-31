<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Supplier_Transaction;
use Illuminate\Http\Request;
use DB;
use Illuminate\Pagination\Paginator;
class SuppliertransactionController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = Supplier_Transaction::join('products as p', 'supplier_transaction.product_id', '=', 'p.id')
            ->join('suppliers as s', 'supplier_transaction.supplier_id', '=', 's.id')
            ->select('supplier_transaction.*', 's.supplier_name', 'p.name')
            ->whereNull('supplier_transaction.deleted_at') // Exclude soft-deleted records
            ->get(); // Retrieve all records without pagination
    
        return view('admin.supplier_transaction.index', compact('suppliers'));
    }
    
    public function create($id)
    {
        $supplier = Supplier::where('id',$id)->first();
        $products = product::all();
        return view('admin.supplier_transaction.create',compact('products','supplier'));
    }

    public function store(request $request)
    {
        $request->validate([
            'product' => 'required|string|max:255',
            'quantity' => 'required|numeric',
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

        $store = new Supplier_Transaction(
            [
                'supplier_id' => $request->supplier_id,
                'product_id' => $request->product,
                'quantity' => $request->quantity,
                'image' => implode(',', $imagePaths), // Implode array into a comma-separated string
            ]
        );
        $store->save();
    
        $product = Product::find($request->product);
        $product->stock += $request->quantity;
        $product->save();

        return redirect()->route('supplier_transaction.index')->with('success','Transaction successful.');

    }

    public function edit($id)
    {
        $supplierTransaction = DB::table('supplier_transaction as st')
            ->join('products as p','st.product_id', '=', 'p.id')
            ->join('suppliers as s','st.supplier_id', '=', 's.id')
            ->where('st.id', $id)
            ->select('st.*','s.supplier_name','p.name')
            ->first();
    
        $productId = $supplierTransaction->product_id;
        $supplierId = $supplierTransaction->supplier_id;
    
        $products = Product::where('id', '!=', $productId)->get();
        $suppliers = Supplier::where('id', '!=', $supplierId)->get();
    
        // Retrieve current quantity
        $currentQuantity = $supplierTransaction->quantity;
    
        return view('admin.supplier_transaction.edit', compact('supplierTransaction', 'products', 'suppliers', 'currentQuantity'));
    }
    
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'supplier' => 'required|string|max:255',
            'product' => 'required|string|max:255',
            'quantity' => 'required|numeric',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $SupplierTransaction = Supplier_Transaction::find($id);
        $previousQuantity = $SupplierTransaction->quantity;
        $currentQuantity = $request->quantity; // Getting current quantity from the form
        $SupplierTransaction->supplier_id = $request->supplier;
        $SupplierTransaction->product_id = $request->product;
        $SupplierTransaction->quantity = $request->quantity;
    
        // Check if new images are uploaded
        if ($request->hasFile('image')) {
            // Handle file upload for multiple images
            $imagePaths = [];
            foreach ($request->file('image') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('product_img'), $imageName);
                $imagePaths[] = 'product_img/' . $imageName;
            }
            $SupplierTransaction->image = implode(',', $imagePaths);
        } else {
            // If no new images uploaded, retain the existing images
            $SupplierTransaction->image = $SupplierTransaction->image;
        }
    
        $SupplierTransaction->save();
    
        // Update stock quantity based on the difference between previous and current quantity
        $product = Product::find($request->product);
        $quantityDifference = $currentQuantity - $previousQuantity;
        $product->stock += $quantityDifference;
        $product->save();
    
        return redirect()->route('supplier_transaction.index')->with('success','Updated successfully.');
    }
    


    public function delete($id) {
        Supplier_Transaction::destroy($id);
        return redirect()->route('supplier_transaction.index')->with('success', 'Deleted successfully.');
    }

}
