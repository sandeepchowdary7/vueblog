<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'professors';

    protected $fillable = [
        'subject_name'
    ];
}
