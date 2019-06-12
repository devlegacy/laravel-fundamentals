<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'name' => $this->name,
          'totalPrice' => (1 - bcdiv($this->discount, 100, 2))* $this->price,
          'rating' => $this->reviews->count() > 0
              ? (float) bcdiv($this->reviews->sum('star'), $this->reviews->count(), 2)
              : 'No rating yet',
          'discount' => $this->discount,
          'href' => [
            'link' => route('products.show', $this->id),
          ],
        ];
    }
}
/**
 php artisan make:resource Product/ProductCollection
 */
