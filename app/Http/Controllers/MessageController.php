<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MessageReceived;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CreateMessageRequest;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMessageRequest $request)
    {
        $message = $request->validated();
        /**
         * Siempre usar queue como recomendación
         */
        Mail::to('samuel@devexteam.com')->queue(new MessageReceived($message));


        // return response('Contenido de la respuesta', 201)
        //         ->header('X-TOKEN', 'secret')
        //         ->header('X-TOKEN-2', 'secret-2')
        //         ->cookie('X-COOKIE', 'cookie');

        // return response()
        //         ->json(['data'=> $message], Response::HTTP_OK)
        //         ->header('X-TOKEN', 'secret');
        return back()
                ->with('info', 'Tú mensaje ha sido enviado correctamente');
    }
}
