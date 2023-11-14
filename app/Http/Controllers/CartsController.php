<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\Carts;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    public function index()
    {
        return CartResource::collection(Carts::all());
    }

    public function store(Request $request)
    {
        $user_id = $request->input('user_id');

        $cart = Carts::create([
            'user_id' => $user_id
        ]);
            return response()->json([
                'data' => new CartResource($cart)
            ], 201);
    }

    public function show(Carts $cart)
    {
    return new CartResource($cart);
    }

    public function update(Request $request, Carts $cart)
    {
        $user_id = $request->input('user_id');

        $cart->update([
            'user_id' => $user_id
        ]);
            return response()->json([
                'data' => new CartResource($cart)
            ], 200);
    }

    public function destroy(Carts $cart)
    {
        $cart->delete();
        return response()->json(null,204);
     }
}
