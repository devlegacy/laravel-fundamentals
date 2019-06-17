<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Product;

class Review extends Model
{
    protected $fillable = ['star','customer','review'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
