<?php
namespace App\Helper\Question\Filters;

class Category implements FilterInterface
{
    /**
     * @param $query
     * @param $value
     */
    public static function filter(\Illuminate\Database\Eloquent\Builder $query, $value)
    {
        //todo get the table names somehow
        if (is_string($value)) {
            $value = explode(',', $value);
        }
        $query
            ->join('question_category as qc', function (\Illuminate\Database\Query\JoinClause $join) use ($value) {
                $join->on(
                    'qc.question_id', '=', 'questions.id');
                $join->whereIn(
                    'qc.category_id', $value);
            });
    }
}

