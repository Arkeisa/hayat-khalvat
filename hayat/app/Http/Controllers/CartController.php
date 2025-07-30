<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController
{
    public function updateCart(Request $request, $id)
    {
        try {
            $quantity = $request->input('quantity');
            
            if ($quantity == 0) {
                // Remove item from cart
                Cart::where('user_id', Auth::id())
                    ->where('product_id', $id)
                    ->delete();
            } else {
                // Update quantity
                Cart::where('user_id', Auth::id())
                    ->where('product_id', $id)
                    ->update(['quantity' => $quantity]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
} 