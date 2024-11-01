<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Redirect;

class RedirectAuthenticatedUser
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Authenticated  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        // Redirect to the desired path after login
        return Redirect::to('/');
    }
}
