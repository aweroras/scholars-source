<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Supplier_Transaction;
use Illuminate\Http\Request;
use DB;
class SuppliertransactionController extends Controller
{
    public function index()
    {
        $suppliers = DB::table('supplier_transaction as st')
        ->join('products as p','st.product_id', '=', 'p.id')
        ->join('suppliers as s','st.supplier_id', '=', 's.id')
        ->select('st.*','s.supplier_name','p.name')
        ->get();
        
        return view('admin.supplier_transaction.index',compact('suppliers'));
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
        ]);

        $store = new Supplier_Transaction(
            [
                'supplier_id' => $request->supplier_id,
                'product_id' => $request->product,
                'quantity' => $request->quantity,
            ]
        );
        $store->save();
    
        $product = Product::find($request->product);
        $product->stock += $request->quantity;
        $product->save();

        return redirect()->route('supplier_transaction.index')->with('success','Transaction to the Supplier is Success');

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

        return view('admin.supplier_transaction.edit',compact('supplierTransaction','products','suppliers'));
    }

    public function update(request $request, $id)
    {
        $request->validate([
            'supplier' => 'required|string|max:255',
            'product' => 'required|string|max:255',
            'quantity' => 'required|numeric',
        ]);
        $SupplierTransaction = Supplier_Transaction::find($id);
        $previousQuantity = $SupplierTransaction->quantity;
        $currentQuantity = $request->quantity;
        $SupplierTransaction->supplier_id = $request->supplier;
        $SupplierTransaction->product_id = $request->product;
        $SupplierTransaction->quantity = $request->quantity;
        $SupplierTransaction->save();

        $product = product::find($request->product);
       if($previousQuantity >= $currentQuantity)
       {
        $newQuantity = $previousQuantity - $currentQuantity;
        $product->stock = $product->stock - $newQuantity;
        $product->save();
       }
       elseif($previousQuantity <= $currentQuantity)
       {
        $newQuantity = $currentQuantity - $previousQuantity;
        $product->stock = $product->stock + $newQuantity;
        $product->save();
       }
       else
       {
        dd('error');
       }


        return redirect()->route('supplier_transaction.index')->with('success','Change Successfully');

    }
}
