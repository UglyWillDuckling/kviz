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

    protected $appends = ['categoryArray'];


    public function category(){
        return $this->belongsToMany('App\Category', 'question_category');
    }

    /**
     * defining accessors
     */
    public function getCategoryIdAttribute($value)
    {
        if (!$this->relations['category']->first()) {
            return false;
        }
        return $this->relations['category']->first()->id;
    }

    public function getCategoryNameAttribute($value)
    {
        if (!$this->relations['category']->first()) {
            return false;
        }
        return $this->relations['category']->first()->name;
    }

    public function getCategoryArrayAttribute($value)
    {
        if (!$this->relations['category']->first()) {
            return false;
        }
        return $this->relations['category']->first()->toArray();
    }
}
