<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Review;

class Product extends Model
{
    // protected $fillable = ['name','detail','stock','price','discount'];
    // protected $connection = '';
    // protected $table = '';
    protected $guarded = [];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
