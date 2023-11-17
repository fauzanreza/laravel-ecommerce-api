<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrdersResource;
use App\Models\Orders;
use App\Models\User;
use App\Models\Carts;
use App\Models\CartItems;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        return OrdersResource::collection(Orders::all());
    }

    public function store(Request $request)
    {
        $user = User::find($request->user_id);
        $cart = Carts::where('user_id', $user->id)->first();
        $cart_items = CartItems::where('cart_id', $cart->id)->get();

        $total_price = 0;
        $items = [];

        foreach ($cart_items as $cart_item) {
            $total_price += $cart_item->subtotal * $cart_item->quantity;

            $items[] = [
                'product_id' => $cart_item->product_id,
                'quantity' => $cart_item->quantity
            ];
        }

        $order = new Orders();
        $order->user_id = $user->id;
        $order->shipping_address = $request->shipping_address;
        $order->payment_method = $request->payment_method;
        $order->total_price = $total_price;
        $order->status = 'placed';
        $order->items = $items;
        $order->save();
            return response()->json([
                'data' => new OrdersResource($order)
            ], 201);
    }

    public function show(Orders $order)
    {
    return new OrdersResource($order);
    }

    public function destroy(Orders $order)
    {
        $order->delete();
        return response()->json(null,204);
     }
}
