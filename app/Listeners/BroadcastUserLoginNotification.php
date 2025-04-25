<?php

namespace App\Listeners;

use App\Events\UserSessionChanged;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class BroadcastUserLoginNotification
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    public function handle(Login $event): void
    {
        //dd($event);
        broadcast(new UserSessionChanged($event->user->email, 'success'));
    }
}
