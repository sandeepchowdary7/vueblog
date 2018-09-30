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
    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    /**
     * Get the course_years for the StudentGroupDetail.
     */
    public function course_year()
    {
        return $this->belongsTo('App\CourseYear');
    }

    /**
     * Get the course_groups for the StudentGroupDetail.
     */
    public function course_group()
    {
        return $this->belongsTo('App\CourseGroup');
    }

    /**
     * Get the course_sections for the StudentGroupDetail.
     */
    public function course_section()
    {
        return $this->belongsTo('App\CourseSection');
    }

    /**
     * Get the subjects for the StudentGroupDetail.
     */
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    /**
     * Get the professors for the StudentGroupDetail.
     */
    public function professor()
    {
        return $this->belongsTo('App\Professor');
    }
}
