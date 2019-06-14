<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Review;

class Product extends Model
{
    protected $fillable = ['name','detail','stock','price','discount'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
