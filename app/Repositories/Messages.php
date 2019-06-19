<?php

namespace App\Repositories;

use App\Entities\Message;

class Messages implements MessagesInterface
{
    public function getPaginated()
    {
        return Message::with(['user','note','tags'])
                            ->orderBy('created_at', request('sorted') ?? 'desc')
                            ->paginate(10);
    }

    public function store($request)
    {
        $message = $request->validated();
        /**
         * Siempre usar queue como recomendación
         */

        // DB::table('messages')->insert([
        //   'name' => request('name'),
        //   'subject' => request('subject'),
        //   'email' => request('email'),
        //   'content' => request('content'),
        //   'created_at' => Carbon::now(),
        //   'updated_at' => Carbon::now(),
        // ]);
        $message = Message::create($message);
        if (auth()->check()) {
            auth()->user()->messages()->save($message);
        }




        // Mail::to('samuel@devexteam.com')->queue(new MessageReceived($message));
        // auth()->user()->messages()->create();

        // $message->user_id = auth()->id()
        // $message->save();

        // return response('Contenido de la respuesta', 201)
        //         ->header('X-TOKEN', 'secret')
        //         ->header('X-TOKEN-2', 'secret-2')
        //         ->cookie('X-COOKIE', 'cookie');

        // return response()
        //         ->json(['data'=> $message], Response::HTTP_OK)
        //         ->header('X-TOKEN', 'secret');
        return $message;
    }

    public function show($id)
    {
        // $message = DB::table('messages')->where('id', $id)->first();

        return Message::findOrFail($id);


        //Edit
        // $message = DB::table('messages')->where('id', $id)->first();
        // $message = Message::findOrFail($id);

        //   $message = Cache::tags('messages')->rememberForever("messsage.$id", function () use ($id) {
        //     return Message::findOrFail($id);
        // });
    }

    public function update($id)
    {
        // DB::table('messages')->where('id', $id)->update([
        //   'name' => request('name'),
        //   'subject' => request('subject'),
        //   'email' => request('email'),
        //   'content' => request('content'),
        //   'updated_at' => Carbon::now(),
        // ]);
        $message = Message::findOrFail($id)->update(request()->all());
        return $message;
    }

    public function destroy($id)
    {
        // DB::table('messages')->where('id', $id)->delete();
        return Message::findOrFail($id)->delete();
    }
}
