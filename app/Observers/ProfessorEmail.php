<?php

namespace App\Observers;
use App\Professor;

class ProfessorEmail
{
    /**
     * Handle the professor "created" event.
     *
     * @param  \App\Professor  $professor
     * @return void
     */
    public function created(Professor $professor)
    {
        //
    }

    /**
     * Handle the professor "updated" event.
     *
     * @param  \App\Professor  $professor
     * @return void
     */
    public function updated(Professor $professor)
    {
        //
    }

    /**
     * Handle the professor "deleted" event.
     *
     * @param  \App\Professor  $professor
     * @return void
     */
    public function deleted(Professor $professor)
    {
        //
    }

    /**
     * Handle the professor "restored" event.
     *
     * @param  \App\Professor  $professor
     * @return void
     */
    public function restored(Professor $professor)
    {
        //
    }

    /**
     * Handle the professor "force deleted" event.
     *
     * @param  \App\Professor  $professor
     * @return void
     */
    public function forceDeleted(Professor $professor)
    {
        //
    }
}
