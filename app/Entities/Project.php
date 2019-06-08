<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // protected $table = '';
    protected $fillable = ['title','description','slug'];
    protected $guarder = []; // ['id','created_at','updated_at'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
