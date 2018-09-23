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
        'gender',
        'dob',
        'is_active',
        'contact_number',
        'address',
        'graduated_year'
    ];
}
