<?php
// php artisan make:model Entities/Sale -m # Linux
// php artisan make:model Entities\Sale -m # Windows

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // protected $fillable = ['name'];
    // protected $connection = '';
    // protected $table = '';
    protected $guarded = ['id'];
}
