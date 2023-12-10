<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductssController extends Controller
{
    public function addProduct(Request $req)
    {
        $validatedData = $req->validate([
            'product_name' => 'required|string',
            'product_barcode' => 'required|unique:products|numeric',
            'product_price' => 'required|numeric|min:0',
        ]);

        $product = Product::create([
            'product_name' => $validatedData['product_name'],
            'product_barcode' => $validatedData['product_barcode'],
            'product_price' => $validatedData['product_price'],
        ]);

        return response()->json(['message' => 'Product added successfully']);
    }

    public function deleteProduct(Request $req)
    {
        $id=$req->id;
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function updateProduct(Request $req)
    {
        $id=$req->id;
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validatedData = $req->validate([
            'product_name' => 'required|string',
            'product_barcode' => 'required|numeric|unique:products,product_barcode,' . $id,
            'product_price' => 'required|numeric|min:0',
        ]);

        $product->update([
            'product_name' => $validatedData['product_name'],
            'product_barcode' => $validatedData['product_barcode'],
            'product_price' => $validatedData['product_price'],
        ]);

        return response()->json(['message' => 'Product updated successfully']);
    }

    public function getProduct(Request $req)
    {
        $id=$req->id;
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json(['product' => $product]);
    }

    public function getAllProducts()
    {
        $products = Product::all();
        return response()->json(['products' => $products]);
    }
}
