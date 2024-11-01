<?php

namespace App\Providers;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Listeners\RedirectAuthenticatedUser; // Pastikan ini mengarah ke lokasi yang benar
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Authenticated::class => [
            RedirectAuthenticatedUser::class,
        ],
    ];

    public function boot()
    {
        //
    }
}
