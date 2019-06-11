<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Message extends Model
{
    //
    protected $fillable = ['name','subject','email','content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
