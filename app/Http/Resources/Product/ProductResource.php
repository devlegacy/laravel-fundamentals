<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->detail,
            'price' => $this->price,
            'stock' => $this->stock > 0
              ? $this->stock
               : 'Out of stock',
            'discount' => $this->discount,
            'totalPrice' => bcmul((1 - bcdiv($this->discount, 100, 2)), $this->price, 2),
            // 17/100 = .17
            // 1 - .17 = .83
            // .83 * 100
            'rating' => $this->reviews->count() > 0
              ? (float) bcdiv($this->reviews->sum('star'), $this->reviews->count(), 2)
              : 'No rating yet',
            'href' => [
              'reviews' => route('reviews.index', $this->id),
            ]
        ];
    }
}
/**
 php artisan make:resource Product/ProductResource
 */
