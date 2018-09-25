<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ProfessorDetail extends Model
{
    public $timestamps = false;
    protected $table = 'professor_details';

    protected $fillable = [
        'role',
        'salary',
        'is_active',
        'joined_on',
        'resigned_at'
    ];

    protected $rules = [
        'role' => 'required',
        'salary' => 'required',
        'is_active' => 'required',
        'joined_on' => 'timestamp',
        'resigned_at' => 'timestamp'
    ];

    /**
     * Get the Professor that owns the ProfessorDetail.
     */
    public function professor()
    {
        return $this->belongsTo('App\Professor');
    }
}
