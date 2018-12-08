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

    protected $dates = ['created_at', 'updated_at'];

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

    /**
     * Each exam date belongsTo one course-year
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
