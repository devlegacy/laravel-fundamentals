<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;

class CacheMessages implements MessagesInterface
{
    protected $messages;

    public function __construct(Messages $messages)
    {
        $this->messages = $messages;
    }

    public function getPaginated()
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
            return $this->messages->getPaginated(); // eager loading vs lazy eager loading
        });
    }

    public function store($request)
    {
        $message = $this->messages->store($request);
        Cache::flush();
        return $message;
    }

    public function show($id)
    {
        return Cache::tags('messages')->rememberForever("messsage.$id", function () use ($id) {
            return $this->messages->show($id);
        });
    }

    public function update($id)
    {
        $message = $this->messages->update($id);
        Cache::tags('messages')->flush();
        return $message;
    }

    public function destroy($id)
    {
        $message = $this->messages->destroy($id);
        Cache::tags('messages')->flush();
        return $message;
    }
}
