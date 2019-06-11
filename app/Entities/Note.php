<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Message;

class Note extends Model
{
    protected $fillable = ['body'];

    public function notable()
    {
        return $this->morphTo();
    }
}
