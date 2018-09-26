<?php

namespace App\Observers;
use App\Professor;
use DB;
use Illuminate\Support\Facades\Input;

class ProfessorRollNumberObserver
{
    /**
     * Handle the professor "created" event.
     *
     * @param  \App\Professor  $professor
     * @return void
     */
    public function created($id)
    {
        $professor = Professor::findOrFail($id);
        $professor->first_name = Input::get('first_name');
        $professor->last_name = Input::get('last_name');
        $professor->dob =  Input::get('dob');

        $firstNameLetter = substr($professor->first_name, 0, 1);
        $lastNameLetter = substr( $professor->last_name, 0, 1);
        $dateOfBirth = substr($professor->dob, 0,4);

        $rollNumber = $firstNameLetter . $lastNameLetter . '@' . $dateOfBirth;

        $professor->created(['roll_number'  => $rollNumber]);
        // dd($professor);
    
        // ->save();
        // dd($result);
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
