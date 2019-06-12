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
        // dd($event->message);
        Mail::to('samuel@devexteam.com')->queue(new MessageReceived($event->message));
    }
}
