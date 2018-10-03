<?php

namespace App\Observers;
use App\Student;

class StudentRollNumberObserver
{
    /**
     * Handle the student "created" event.
     *
     * @param  \App\Student  $student
     * @return void
     */
    public function created(Student $student)
    {
        $firstNameLetter = substr($student->first_name, 0, 1);
        $lastNameLetter = substr( $student->last_name, 0, 1);
        $dateOfBirth = substr($student->dob, 0,4);
        $rollNumber = strtoupper($firstNameLetter) . strtolower($lastNameLetter) . '@' . $dateOfBirth . chr(65 + rand(0, 25));

        $student->update([
            'roll_number' => $rollNumber,
        ]);
    }

    /**
     * Handle the student "updated" event.
     *
     * @param  \App\Student  $student
     * @return void
     */
    public function updated(Student $student)
    {
        //
    }

    /**
     * Handle the student "deleted" event.
     *
     * @param  \App\Student  $student
     * @return void
     */
    public function deleted(Student $student)
    {
        //
    }

    /**
     * Handle the student "restored" event.
     *
     * @param  \App\Student  $student
     * @return void
     */
    public function restored(Student $student)
    {
        //
    }

    /**
     * Handle the student "force deleted" event.
     *
     * @param  \App\Student  $student
     * @return void
     */
    public function forceDeleted(Student $student)
    {
        //
    }
}
