<?php

namespace App\Observers;
use App\Professor;

class ProfessorRollNumberObserver
{
    /**
     * Handle the professor "created" event.
     *
     * @param  \App\Professor  $professor
     * @return void
     */
    public function created($professor)
    {
        $firstNameLetter = substr($professor->first_name, 0, 1);
        $lastNameLetter = substr( $professor->last_name, 0, 1);
        $dateOfBirth = substr($professor->dob, 0,4);
        $rollNumber = strtoupper($firstNameLetter) . strtolower($lastNameLetter) . '@' . $dateOfBirth . chr(65 + rand(0, 25));

        $professor->update([
            'roll_number' => $rollNumber,
        ]);
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
