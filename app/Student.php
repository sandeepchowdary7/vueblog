<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
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
}