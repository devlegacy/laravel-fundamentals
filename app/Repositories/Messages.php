<?php

namespace App\Repositories;

use App\Entities\Message;
use Illuminate\Support\Facades\Cache;

class Messages
{
    public function getPaginated(Type $var = null)
    {
        // DB::listen(function ($query) {
        //     echo "<pre>{$query->sql} - {$query->time}</pre>";
        // });
        // $messages = DB::table('messages')->get();
        // $messages = Message::all();
        // $messages = Message::with(['user','note','tags'])->get(); // eager loading vs lazy eager loading
        $cacheKey = 'db.messages.page.'.request('page', 1);
        // if (Cache::has($cacheKey)) {
        //     $messages = Cache::get($cacheKey);
        // } else {
        //     $messages = Message::with(['user','note','tags'])
        //                     ->orderBy('created_at', request('sorted') ?? 'asc')
        //                     ->paginate(10); // eager loading vs lazy eager loading
        //     Cache::put($cacheKey, $messages, Carbon::now()->addMinutes(10));
        // }
        // Cache::remember(%cacheKey, Carbon::now()->addMinutes(10), function() {
        // try {
        //     $redis=Redis::connect('127.0.0.1', 3306);
        //     Redis::set('name', 'Taylor');
        //     return response('redis working');
        // } catch (\Predis\Connection\ConnectionException $e) {
        //     dump($e);
        //     return response('error connection redis');
        // }

        return Cache::tags('messages')->rememberForever($cacheKey, function () use ($cacheKey) {
            return Message::with(['user','note','tags'])
                            ->orderBy('created_at', request('sorted') ?? 'desc')
                            ->paginate(10); // eager loading vs lazy eager loading
        });
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

        Cache::flush();


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
        return Cache::tags('messages')->rememberForever("messsage.$id", function () use ($id) {
            return Message::findOrFail($id);
        });

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
        Message::findOrFail($id)->update(request()->all());
        Cache::tags('messages')->flush();
    }

    public function destroy($id)
    {
      // DB::table('messages')->where('id', $id)->delete();
      Message::findOrFail($id)->delete();
      Cache::tags('messages')->flush();
    }
}
