<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MessageReceived;
use Illuminate\Support\Facades\Mail;

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
        $message = request()->validate(
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
        /**
         * Siempre usar queue como recomendación
         */
        Mail::to('samuel@devexteam.com')->queue(new MessageReceived($message));

        return 'Mensaje enviado';
    }
}
