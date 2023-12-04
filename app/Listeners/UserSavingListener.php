<?php

namespace App\Listeners;

use App\Events\UserSaving;
use GuzzleHttp\Psr7\Request;

class UserSavingListener
{
    /**
     * Handle the event.
     *
     * @param  UserSaving  $event
     * @return void
     */
    public function handle(UserSaving $event)
    {
        app('log')->info($event->user);
        //  return redirect()->back();
        // dd('sfdsds');
    }
}