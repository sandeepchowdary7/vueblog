<?php

namespace App\Listeners;

use App\ProfessorDetail;
use App\Events\ProfessorDetailDelete;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProfessorDetailDeleteNotification
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
     * @param  ProfessorDetailDelete  $event
     * @return void
     */
    public function handle(ProfessorDetailDelete $event)
    {
        ProfessorDetail::where('professor_id', $event->professor)->delete();
    }
}
