<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = 'media_id';
}
