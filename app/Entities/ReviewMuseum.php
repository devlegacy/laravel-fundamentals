<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Entities\Museum;

class ReviewMuseum extends Model
{
    // protected $connection = '';
    protected $table = 'museum_reviews';
    // protected $fillable = ['name'];
    // protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function museum()
    {
        return $this->belongsTo(Museum::class);
    }
}
