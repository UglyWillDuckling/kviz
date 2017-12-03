<?php
namespace App\Helper;

use Illuminate\Http\Request;
use App\Question as QuestionModel;
use App\Helper\Question\QueryBuilder;

class Question
{
    public function buildResponse(\Illuminate\Pagination\LengthAwarePaginator  $result) {
        $result = $result->toArray();
        $result['questions'] = $result['data'];
        unset($result['data']);

        return $result;
    }

}
