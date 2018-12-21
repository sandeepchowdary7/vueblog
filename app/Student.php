<?php

namespace App;
use App\Events\StudentDeleted;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use Notifiable;
    protected $table = 'students';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'guardian_name',
        'roll_number',
        'gender',
        'dob',
        'gender',
        'dob' ,                   
        'contact_number', 
        'address', 
        'graduated_year',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'deleted' => StudentDeleted::class
    ];
}