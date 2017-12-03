<?php
namespace App\Repository;

use App\Question as QuestionModel;
use App\Helper\Question\QueryBuilder;

class Question
{
    const DEFAULT_PAGE_SIZE = 20;

    public $queryBuilder;
    public $query;

    public function __construct(QueryBuilder $queryBuilder)
    {
        $this->query  = QuestionModel::query();
        $this->queryBuilder = $queryBuilder;
    }

    public function getQuestions(array $fields, $perPage = 20, $page = 1)
    {
        $this->queryBuilder->applyFilters($this->query, $fields);
        return $this->query->paginate(
            $perPage ?: self::DEFAULT_PAGE_SIZE, $columns = ['*'], $pageName = 'page', $page
        );
    }
}
