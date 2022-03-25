<?php

namespace App\Listeners;

use App\Events\MakeOrderEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MakeOrderListener
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
     * @param  \App\Events\MakeOrderEvent  $event
     * @return void
     */
    public function handle(MakeOrderEvent $event)
    {
        //
    }
}
