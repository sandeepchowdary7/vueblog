<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Exam extends Model
{
    use Userstamps;
    protected $table = 'exams';

    protected $fillable = [
        'exam_date',
    ];

    /**
     * Each exam date belongsTo one subject
     */
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    /**
     * Each exam date belongsTo one course-year
     */
    public function CourseYear()
    {
        return $this->belongsTo('App\CourseYear');
    }
}
