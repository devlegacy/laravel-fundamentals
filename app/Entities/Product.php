<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Review;

class Product extends Model
{
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
