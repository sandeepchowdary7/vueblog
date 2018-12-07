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
     * Get the ProfessorDetail record associated with the Professor.
     */
    public function professor_detail()
    {
        return $this->hasOne('App\ProfessorDetail');
    }
}
