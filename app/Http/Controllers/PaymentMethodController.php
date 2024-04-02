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
            'payment_name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);

        $paymentMethod = new PaymentMethod;
        $paymentMethod->payment_name = $request->payment_name;
        $paymentMethod->image = $imageName;
        $paymentMethod->save();

        return redirect()->route('admin.payment_method.index')
                         ->with('success','Payment Method created successfully.');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.payment_method.edit', compact('paymentMethod'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $request->validate([
            'payment_name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $paymentMethod->image = $imageName;
        }

        $paymentMethod->payment_name = $request->payment_name;
        $paymentMethod->save();

        return redirect()->route('admin.payment_method.index')
                         ->with('success','Payment Method updated successfully.');
    }
}