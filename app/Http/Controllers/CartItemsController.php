<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartItemResource;
use App\Models\CartItems;
use Illuminate\Http\Request;

class CartItemsController extends Controller
{
    public function index()
    {
        return CartItemResource::collection(CartItems::all());
    }

    public function store(Request $request)
    {
        $cart_id = $request->input('cart_id');
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $subtotal = $request->input('subtotal');

        $cart_item = CartItems::create([
            'cart_id' => $cart_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'subtotal' => $subtotal
        ]);
            return response()->json([
                'data' => new CartItemResource($cart_item)
            ], 201);
    }

    public function show(CartItems $cart_item)
    {
    return new CartItemResource($cart_item);
    }

    public function update(Request $request, CartItems $cart_item)
    {
        $cart_id = $request->input('cart_id');
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $subtotal = $request->input('subtotal');

        $cart_item->update([
            'cart_id' => $cart_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'subtotal' => $subtotal
        ]);
            return response()->json([
                'data' => new CartItemResource($cart_item)
            ], 200);
    }

    public function destroy(CartItems $cart_item)
    {
        $cart_item->delete();
        return response()->json(null,204);
     }
}