<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Message;
use App\User;

class Tag extends Model
{
    protected $fillable = ['name'];
    // protected $connection = '';
    // protected $table = '';
    // protected $guarded = [];

    public function messages()
    {
        return $this->morphByMany(Message::class, 'taggable');
    }

    public function users()
    {
        return $this->morphByMany(User::class, 'taggable');
    }
}
