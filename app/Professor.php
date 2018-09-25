<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $table = 'professors';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'roll_number',
        'gender',
        'dob',
        'email',
        'phone_number',
        'address'
    ];

    // protected $rules = [
    //     'first_name'            =>  'required|max:20',
    //     'middle_name'       =>  'required|max:20',
    //     'last_name'            =>   'required|max:20',
    //     'roll_number'        =>   'required|unique',
    //     'gender'              	 =>   'required',
    //     'dob'                     =>   'required|date',
    //     'email'                  =>   'required|unique',
    //     'phone_number'   =>   'required|digits:15',
    //     'address'               =>   'required|max:300'
    // ];

    /**
     * Get the ProfessorDetail record associated with the Professor.
     */
    public function professor_detail()
    {
        return $this->hasOne('App\ProfessorDetail');
    }
}
