<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\RegisterEvent;
use App\Mail\Register;
use Exception;


class RegisterListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(RegisterEvent $event)
    {
        // try {
            \Mail::to(['address' => $event->user->email])
                ->send(new Register($event->user));
        // } catch (\Throwable $th) {
        //     throw new Exception("Can't Send Email");
        // }
    }
}
