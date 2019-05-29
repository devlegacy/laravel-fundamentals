<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MessageReceived;

class MessagesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(
            [
              'name' => 'required',
              'email' => 'required|email',
              'subject' => 'required',
              'content' => 'required|min:3',
            ],
            [
              'name.required' => __('The app need your name'),
            ]
        );

        Mail::to('samuel@devexteam.com')->send(new MessageReceived);

        return 'Mensaje enviado';
    }
}
