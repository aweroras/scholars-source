<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('supplier_images'), $imageName);

        $supplier = new Supplier([
            'supplier_name' => $request->name,
            'image' => $imageName,
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
    $supplier = Supplier::find($id);
    $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imageName = time().'.'.$request->image->extension();  
    $request->image->move(public_path('supplier_images'), $imageName);
    $supplier->image = $imageName; 
    $supplier->supplier_name = $request->name;
    $supplier->save();

    return redirect()->route('supplier.index')->with('success', 'Edit Supplier Successfully');
    }

    public function delete($id) {
        Supplier::destroy($id);
        return redirect()->route('supplier.index')->with('success', 'Delete Supplier Successfully');
    }
}
