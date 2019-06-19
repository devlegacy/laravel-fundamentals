<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MessageReceived;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CreateMessageRequest;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Entities\Message;
use App\Events\MessageWasReceived;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['create','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        $messages = Cache::tags('messages')->rememberForever($cacheKey, function () use ($cacheKey) {
            return Message::with(['user','note','tags'])
                            ->orderBy('created_at', request('sorted') ?? 'desc')
                            ->paginate(10); // eager loading vs lazy eager loading
        });
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

        event(new MessageWasReceived($message));
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
        // $message = DB::table('messages')->where('id', $id)->first();
        $message = Cache::tags('messages')->rememberForever("messsage.$id", function () use ($id) {
            return Message::findOrFail($id);
        });
        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $message = DB::table('messages')->where('id', $id)->first();
        // $message = Message::findOrFail($id);
        $message = Cache::tags('messages')->rememberForever("messsage.$id", function () use ($id) {
            return Message::findOrFail($id);
        });
        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
        return redirect()->route('messages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // DB::table('messages')->where('id', $id)->delete();
        Message::findOrFail($id)->delete();
        Cache::tags('messages')->flush();
        return redirect()->route('messages.index');
    }
}
