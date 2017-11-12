<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'body',
        'image',
        'video',
        'number_of_answers',
        'type_of_answer',
        'time_limit',
        'is_multipart',
        'enabled',
        'approved',
    ];
}
