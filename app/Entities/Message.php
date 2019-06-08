<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = ['name','subject','email','content'];
}
