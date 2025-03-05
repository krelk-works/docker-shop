<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use App\Listeners\MergeCart;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            MergeCart::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
