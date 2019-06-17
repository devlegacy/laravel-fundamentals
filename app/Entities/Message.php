<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Entities\Note;
use App\Entities\Tag;

class Message extends Model
{
    //
    protected $fillable = ['name','subject','email','content'];
    // protected $connection = '';
    // protected $table = '';
    // protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function note()
    {
        return $this->morphOne(Note::class, 'notable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}


/**
 $m = App\Entities\Message::first()
 $m->note()->create(['body'=>'Nota del mensaje 1']);

 $u = App\User::first();
 $u->note()->create(['body'=>'Nota del usuario 1']);

 $m = App\Entities\Message::first()
 $m->tags()->create(['name'=>'Importante']);

 $tag = App\Entities\Tag::create(['name' => 'No importante']);
 $m->tags()->save($tag);
 */
