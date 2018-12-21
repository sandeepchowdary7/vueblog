<?php

namespace App\Listeners;

use App\Events\StudentDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StudentDeletedNotification
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
     * @param  StudentDeleted  $event
     * @return void
     */
    public function handle(StudentDeleted $event)
    {
        //
    }
}
