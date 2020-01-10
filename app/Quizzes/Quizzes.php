<?php

namespace App\Quizzes;

use Illuminate\Database\Eloquent\Model;

class Quizzes extends Model
{
    protected $table = 'quizzes';
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'c_id';
}
