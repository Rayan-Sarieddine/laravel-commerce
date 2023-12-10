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
            "active"=> "required|boolean",
        ]);
        $cart=Order::create([
            'product_id' => $validatedData['product_id'],
            'user_id' => $validatedData['user_id'],
            'product_amount' => $validatedData['product_amount'],
        ]);
        return response()->json(['message' => 'order added successfully']);
    }
}
