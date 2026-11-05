<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart; // Connects to your Cart database table
use Illuminate\Support\Facades\Auth; // Allows us to identify the logged-in user

class CartController extends Controller
{
    // 1. Add an item to the cart
    public function add($productId)
    {
        $userId = Auth::id();

        // Check if this specific user already has this exact product in their cart
        $existingCartItem = Cart::where('user_id', $userId)
                                ->where('product_id', $productId)
                                ->first();

        if ($existingCartItem) {
            // If it's already in the cart, just increase the quantity by 1
            $existingCartItem->increment('quantity');
        } else {
            // If not, create a brand new entry in the cart table
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }

        // Send the user back to whatever page they were on with a success message
        return back()->with('success', 'Product added to your cart!');
    }

    // 2. Show the user their cart page
    public function index()
    {
        // Fetch all cart items for the logged-in user, and bring along the product details
        $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        
        return view('cart', ['cartItems' => $cartItems]);
    }
}