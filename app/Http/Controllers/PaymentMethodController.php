<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::all();
        return view('admin.payment_method.index', compact('paymentMethods'));
    }

    public function create()
    {
        return view('admin.payment_method.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePaths = [];
        if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('product_img'), $imageName);
                    $imagePaths[] = 'product_img/' . $imageName;
                }
        }

        $PaymentMethod = new PaymentMethod([
           'payment_name' => $request->name,
           'image' => implode(',', $imagePaths),
       ]);
       $PaymentMethod->save();

        return redirect()->route('admin.payment_method.index')
                         ->with('success','Payment Method created successfully.');
    }

    public function update($id)
    {
        $paymentMethod = PaymentMethod::where('id',$id)->first();

        return view('admin.payment_method.edit', compact('paymentMethod'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $PaymentMethod = PaymentMethod::find($id);
    
        if (!$PaymentMethod) {
            return redirect()->route('supplier.index')->with('error', 'Supplier not found.');
        }
    
        // Update supplier name
        $PaymentMethod->payment_name = $request->name;
        // Handle image upload

        // Check if new images are uploaded
        if ($request->hasFile('image')) {
            // Handle file upload for multiple images
            $imagePaths = [];
            foreach ($request->file('image') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('product_img'), $imageName);
                $imagePaths[] = 'product_img/' . $imageName;
            }
            $PaymentMethod->image = implode(',', $imagePaths);
        } else {
            // If no new images uploaded, retain the existing images
            // If no new images uploaded, retain the existing images
        $PaymentMethod->image = $PaymentMethod->image;

        }
    
        $PaymentMethod->save();
    
        return redirect()->route('admin.payment_method.index')->with('success', 'Payment Method updated successfully');
    }

    public function delete($id)
{
    $paymentMethod = PaymentMethod::find($id);
    if ($paymentMethod) {
        // Soft delete the payment method
        $paymentMethod->delete();
        return redirect()->route('admin.payment_method.index')->with('success', 'Payment Method soft deleted successfully');
    } else {
        return redirect()->route('admin.payment_method.index')->with('error', 'Payment Method not found.');
    }
}

public function restoreAll()
{
    // Restore all soft deleted payment methods
    PaymentMethod::withTrashed()->restore();

    return redirect()->route('admin.payment_method.index')->with('success', 'All soft deleted payment methods have been restored.');
}

}