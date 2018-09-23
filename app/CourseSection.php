<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{
    protected $table = 'course_sections';

    protected $fillable = [
        'section_name',
    ];
}
