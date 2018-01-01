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
        'is_multipart',
        'time_limit',
        'approved',
        'enabled',
        'status'
    ];

    protected $appends = ['categoryIds'];


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
    public function getCategoryIdsAttribute($value)
    {
        if (!isset($this->relations['category']) ||  !$this->relations['category']->first()) {
            return false;
        }
        return $this->relations['category']->pluck('id')->toArray();
    }
}
