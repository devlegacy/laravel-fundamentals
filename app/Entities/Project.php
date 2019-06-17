<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title','description','slug'];
    // protected $connection = '';
    // protected $table = '';
    // protected $guarded = []; // ['id','created_at','updated_at'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
