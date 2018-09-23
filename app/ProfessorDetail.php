<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ProfessorDetail extends Model
{
    protected $table = 'professor_details';

    protected $fillable = [
        'role',
        'salary',
        'is_active',
        'gender',
        'dob',
        'email',
        'joined_on',
        'resigned_at'
    ];
}
