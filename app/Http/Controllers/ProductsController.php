<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Products;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Products::paginate(5));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'price' => 'required|integer',
            'description' => 'required|string',
            'stock' => 'required|integer',
            'image_url' => 'required|array'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' =>
            $validator->errors()], 400);
        }

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

    public function update(Request $request, Products $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'price' => 'required|integer',
            'description' => 'required|string',
            'stock' => 'required|integer',
            'image_url' => 'required|array'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' =>
            $validator->errors()], 400);
        }
    
        $product_name = $request->input('name');
        $product_price = $request->input('price');
        $product_description = $request->input('description');
        $product_stock = $request->input('stock');
        $product_image_url = $request->input('image_url');

        $product->update([
            'name' => $product_name,
            'price' => $product_price,
            'description' => $product_description,
            'stock' => $product_stock,
            'image_url' => $product_image_url,
        ]);
            return response()->json([
                'data' => new ProductResource($product)
            ], 200);
    }

    public function destroy(Products $product)
    {
        $product->delete();
        return response()->json(null,204);
     }
}
