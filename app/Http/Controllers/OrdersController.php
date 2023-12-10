<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
class OrdersController extends Controller
{
    public function order(Request $req){
        $product_id = $req->product_id;
        $user_id = $req->user_id;
        $user=User::find($user_id);
        $product=Product::find($product_id);
        if(!$user || !$product){
            return response()->json(['message'=>'invalid id']);
        }
        $validatedData = $req->validate([
            "user_id"=> "required|numeric",
            "product_id"=> "required|numeric",
            "product_amount"=> "required|numeric",
        ]);
        $order=Order::create([
            'product_id' => $validatedData['product_id'],
            'user_id' => $validatedData['user_id'],
            'product_amount' => $validatedData['product_amount'],
        ]);
        return response()->json(['message' => 'order added successfully']);
    }
}
