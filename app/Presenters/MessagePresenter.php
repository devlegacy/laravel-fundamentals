<?php

namespace App\Presenters;

use App\Entities\Message;
use Illuminate\Support\HtmlString;

class MessagePresenter extends Presenter
{
    public function getUserName()
    {
        // @if ($message->user_id)
        //   <a href="{{route('users.show',$message->user_id)}}">{{$message->user->name}}</a>
        // @else
        //   {{$message->name}}
        // @endif
        return $this->model->user_id
                ? $this->getUserNameLink()
                : $this->model->name;
    }

    public function getUserEmail()
    {
        // $message->user_id ? $message->user->email : $message->email
        return $this->model->user_id ? $this->model->user->email :$this->model->email;
    }

    public function link()
    {
        return new HtmlString("<a href=".route('messages.show', $this->model->id).">{$this->model->content}</a>");
    }

    public function getUserNameLink()
    {
        // return "<a href='".route('users.show', $this->model->user_id)."'>{$this->model->user->name}</a>";
        return $this->model->user->present()->link();
    }

    public function getNotes()
    {
        // {{ $message->note->body ?? '' }}
        return $this->model->note->body ?? '';
    }

    public function getTags()
    {
        // {{ $message->tags->pluck('name')->implode(', ') }}
        return $this->model->tags->pluck('name')->implode(', ');
    }
}
