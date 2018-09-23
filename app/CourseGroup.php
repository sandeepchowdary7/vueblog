<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class CourseGroup extends Model
{
    protected $table = 'course_groups';

    protected $fillable = [
        'group_name'
    ];
}
