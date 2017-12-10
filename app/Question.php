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


    public function answers() {
        return $this->hasMany('App\Answer', 'questionId');
    }


    public function category(){
        return $this->belongsToMany('App\Category', 'question_category');
    }

    public function scopeInCategory ($query, $id) {
        return $query->whereHas('category', function ($q) use ($id) {
            $q->where($this->category()->getQualifiedRelatedPivotKeyName(), $id);
        });
    }

    public function scopeStatus($q, $status){
        return $q->where('status', $status);
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
        if (!isset($this->relations['category']) ||
            !$this->relations['category']->first()) {
            return false;
        }
        return $this->relations['category']->first()->toArray();
    }
}
