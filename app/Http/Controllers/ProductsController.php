<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Products::all());
    }

    public function store(Request $request)
    {
        $product_name = $request->input('name');
        $product_price = $request->input('price');
        $product_description = $request->input('description');
        $product_stock = $request->input('stock');
        $product_image_url = $request->input('image_url');

        $product = Products::create([
            'name' => $product_name,
            'price' => $product_price,
            'description' => $product_description,
            'stock' => $product_stock,
            'image_url' => $product_image_url,
        ]);
            return response()->json([
                'data' => new ProductResource($product)
            ], 201);
    }

    public function show(Products $product)
    {
    return new ProductResource($product);
    }

    public function update(Request $request, string $id)
    {
        //
    }
    
    public function destroy(string $id)
    {
        //
    }
}
