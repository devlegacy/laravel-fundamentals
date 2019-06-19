<?php

namespace App\Presenters;

use Illuminate\Support\HtmlString;

class UserPresenter extends Presenter
{
    public function link()
    {
        return new HtmlString("<a href=".route('users.show', $this->model->id).">{$this->model->name}</a>");
    }

    public function roles()
    {
        // {{ $user->roles->pluck('display_name')->implode(', ') }}
        // {{-- @foreach ($user->roles as $role)
        //     {{$role->display_name}}
        // @endforeach --}}
        return $this->model->roles->pluck('display_name')->implode(', ');
    }

    public function notes()
    {
        // {{ $user->note->body ?? '' }}
        return $this->model->note->body ?? '';
    }

    public function tags()
    {
        // {{ $user->tags->pluck('name')->implode(', ') }}
        return $this->model->tags->pluck('name')->implode(', ');
    }
}
