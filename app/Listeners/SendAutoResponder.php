<?php

namespace App\Listeners;

use App\Events\MessageWasReceived;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\MessageReceived;
use Illuminate\Support\Facades\Mail;

class SendAutoResponder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MessageWasReceived  $event
     * @return void
     */
    public function handle(MessageWasReceived $event)
    {
        $message = $event->message;
        // dd($event->message);
        if (auth()->check()) {
            $message->name = auth()->user()->name;
            $message->email = auth()->user()->email;
        }
        Mail::to('samuel@devexteam.com', 'Samuel R.')->queue(new MessageReceived($message));
    }
}
