<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MessageReceived;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CreateMessageRequest;
use Symfony\Component\HttpFoundation\Response;
use DB;
use Carbon\Carbon;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = DB::table('messages')->get();
        return view('messages.index', compact('messages'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create');
    }

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

        DB::table('messages')->insert([
          'name' => request('name'),
          'subject' => request('subject'),
          'email' => request('email'),
          'content' => request('content'),
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ]);


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
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $message = DB::table('messages')->where('id', $id)->get()->first();
        return view('messages.show', compact('message'));
    }
}
