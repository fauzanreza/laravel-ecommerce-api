<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{
   /**
     * Transform the resource into an arrays.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'items' => $this->items,
            'shipping_address' => $this->shipping_address,
            'payment_method' => $this->payment_method,
            'total_price' => $this->total_price,
            'status' => $this->status
        ];
    }
}
