<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{
    protected $table = 'course_sections';

    public $timestamps = false;

    protected $fillable = [
        'section_name',
    ];
}
