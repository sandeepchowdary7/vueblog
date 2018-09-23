<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class CourseYear extends Model
{
    protected $table = 'course_years';

    protected $fillable = [
        'year'
    ];
}
