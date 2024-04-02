<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;
class CourierController extends Controller
{
    public function index()
    {
        // Retrieve only non-deleted couriers
        $couriers = Courier::all();
    
        // Pass the couriers to the view
        return view('admin.courier.index', compact('couriers'));
    }
    

    public function create()
    {

        return view('admin.courier.create');
    }

    public function store(request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
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

         $Courier = new Courier([
            'courier_name' => $request->name,
            'branch' => $request->branch,
            'image' => implode(',', $imagePaths),
        ]);
        $Courier->save();

        return redirect()->route('courier.index')->with('success', 'Courier add successfully');

    }


    public function update($id)
    {
        $courier = Courier::where('id',$id)->first();
        
        return view('admin.courier.update',compact('courier'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $Courier = Courier::find($id);
    
        if (!$Courier) {
            return redirect()->route('courier.index')->with('error', 'courier not found.');
        }
    
        // Update supplier name
        $Courier->courier_name = $request->name;
        $Courier->branch = $request->branch;
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
            $Courier->image = implode(',', $imagePaths);
        } else {
            // If no new images uploaded, retain the existing images
            // If no new images uploaded, retain the existing images
$Courier->image = $Courier->image;

        }
    
        $Courier->save();
    
        return redirect()->route('courier.index')->with('success', 'courier updated successfully');
    }

    public function delete($id)
    {
        $courier = Courier::find($id);
        if ($courier) {
            $courier->delete();
            return redirect()->route('courier.index')->with('success', 'Courier soft deleted successfully');
        } else {
            return redirect()->route('courier.index')->with('error', 'Courier not found.');
        }
    }

    public function restoreAll()
    {
        // Restore all soft deleted couriers
        Courier::onlyTrashed()->restore();
    
        return redirect()->route('courier.index')->with('success', 'All soft deleted couriers have been restored.');
    }
    




}
