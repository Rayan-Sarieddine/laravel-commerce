<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\models\Order;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    public function addToCart(Request $req){
        $user_id= $req->user_id;
        $order_id= $req->order_id;

        $user=User::find($user_id);
        $order=Order::find($order_id);

        if(!$user || !$order){
            return response()->json(['message'=>'invalid credentials']);
        }
        $validatedData = $req->validate([
            "user_id"=> "required|numeric",
            "order_id"=> "required|numeric",
            "active_cart"=> "required|boolean",
        ]);
        $cart=Order::create([
            'product_id' => $validatedData['product_id'],
            'user_id' => $validatedData['user_id'],
            'active' => $validatedData['active_cart'],
        ]);
        return response()->json(['message' => 'order added successfully']);
    }
    public function removeFromCart(Request $req){
        $user_id = $req->user_id;
        $order_id = $req->order_id;
    
        $user = User::find($user_id);
        $order = Order::find($order_id);
    
        if (!$user || !$order) {
            return response()->json(['message' => 'Invalid credentials']);
        }
    
        // Logic to remove the order from the cart
        $removed = $order->delete();
    
        if ($removed) {
            return response()->json(['message' => 'Order removed successfully']);
        } else {
            return response()->json(['message' => 'Failed to remove order']);
        }
    }
    public function viewCart(Request $req){
        $user_id = $req->user_id;
    
        $user = User::find($user_id);
    
        if (!$user) {
            return response()->json(['message' => 'Invalid user']);
        }
    
        
        $cart = Order::where('user_id', $user_id)
                      ->where('active', true)
                      ->get();
    
        if ($cart->isEmpty()) {
            return response()->json(['message' => 'No active orders in the cart']);
        }
    
        return response()->json(['cart' => $cart]);
    }
    
}
