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

    /**
     * Get the Professor that owns the ProfessorDetail.
     */
    public function professor()
    {
        return $this->belongsTo('App\Professor');
    }
}
