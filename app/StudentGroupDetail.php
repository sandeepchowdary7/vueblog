<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class StudentGroupDetail extends Model
{
    protected $table = 'student_group_details';

    protected $fillable = [
        'student_id',
        'course_year_id',
        'course_group_id',
        'course_section_id',
        'subject_id',
        'professor_id'
    ];
    
    /**
     * Get the students for the StudentGroupDetail.
     */
    public function students()
    {
        return $this->hasMany('App\Student');
    }

    /**
     * Get the course_years for the StudentGroupDetail.
     */
    public function course_years()
    {
        return $this->hasMany('App\CourseYear');
    }

    /**
     * Get the course_groups for the StudentGroupDetail.
     */
    public function course_groups()
    {
        return $this->hasMany('App\CourseGroup');
    }

    /**
     * Get the course_sections for the StudentGroupDetail.
     */
    public function course_sections()
    {
        return $this->hasMany('App\CourseSection');
    }

    /**
     * Get the subjects for the StudentGroupDetail.
     */
    public function subjects()
    {
        return $this->hasMany('App\Subject');
    }

    /**
     * Get the professors for the StudentGroupDetail.
     */
    public function professors()
    {
        return $this->hasMany('App\Professor');
    }
}
