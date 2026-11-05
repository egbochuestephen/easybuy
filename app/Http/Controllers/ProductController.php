<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Brings in our Product database model
use Illuminate\Support\Facades\Auth; // Allows us to get the logged-in user

class ProductController extends Controller
{
    // 1. Show the page with the upload form
    public function create()
    {
        return view('create-product');
    }

    // 2. Process the form and save the image
    public function store(Request $request)
    {
        // Step A: Validate the incoming data (make sure the image is actually an image)
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // Step B: Save the image file to the server
        // This puts the image in the 'storage/app/public/products' folder
        $imagePath = $request->file('image')->store('products', 'public');

        // Step C: Save the product details to the database
        Product::create([
            'user_id' => Auth::id(), // Links product to the person uploading it
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath, 
        ]);

        // Step D: Send them back to the dashboard with a success message
        return redirect('/dashboard')->with('success', 'Product uploaded successfully!');
    }
}