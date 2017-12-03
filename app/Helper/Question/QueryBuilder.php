<?php
namespace App\Helper\Question;

use Illuminate\Http\Request;


class QueryBuilder
{

    /**
     * @param array $fields
     * @return \Illuminate\Database\Eloquent\Builder
     */
//    public function generateQuery(array $fields)
//    {
//        /**
//         * @var $query \Illuminate\Database\Eloquent\Builder
//         */
//        $query = $this->query;
//
//        if (!empty($fields['diff_time'])) {
//            $this->filterTime(
//                $query, $fields['diff_time']);
//        }
//        if (!empty($fields['status'])) {
//            $this->filterStatus(
//                $query, MealModel::STATUS_ENABLED);
//        }
//
//        //filter the query
//        $this->filter($fields, $query);
//
//        $this->addRelations(
//           $fields['with'], !empty($fields['lang']));
//
//        return $query;
//    }

    public function applyFilters($query, $filters) {
        foreach ($filters as $filter => $value) {
            $scope = "scope{$filter}";
            if ( method_exists($query->getModel(), camel_case($scope)) ) {
                $query->{$filter}($value);
            }
        }
        return $query;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $time
     * @param string $field
     */
    public function filterTime(\Illuminate\Database\Eloquent\Builder $query, $time, $field = 'updated_at') {
        $query->where(
            'meals.'.$field, '>=', date("Y-m-d h:i:s", strtotime($time))
        );
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $status
     */
    public function filterStatus(\Illuminate\Database\Eloquent\Builder $query, $status) {
        $query->where('status', '=', $status);
    }

    /**
     * @param $lang
     */
    public function addLang($lang)
    {
        $this->query
            ->join('meals_translation as ' .
                MealModel::getTableAlias('meals_translation'), function (\Illuminate\Database\Query\JoinClause $join) use ($lang) {
                $join->on(
                    MealModel::getTableAlias('meals_translation') . '.meal_id',
                    '=',
                    $this->query->getModel()->getTable().'.id'
                );
                $join->where(
                    MealModel::getTableAlias('meals_translation') . '.language_id',
                    '=',
                    $lang
                );
            });
    }

    /**
     * filter by given fields using specific filter classes
     *
     * @param array $fields
     *
     *TODO refactor so it uses a default filter when a filter class does not exist
     */
    public function filter(array $fields)
    {
        foreach ($fields as $field => $value) {
            $decorator =
                __NAMESPACE__ . '\\Filters\\' .
                str_replace(' ', '', ucwords(
                    str_replace('_', ' ', $field)));

            if (class_exists($decorator)) {
                $decorator::filter($this->query, $value);
            }
        }
    }
}
