<?php

namespace App\Filters\v1;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class TodoFilter extends ApiFilter
{
    protected $allowedFilters = [
        'title' => ['lk'],
        'description' => ['lk'],
        'isCompleted' => ['lk','eq','ne','gt','lt','gte','lte'],
        'startDate' => ['lk','eq','ne','gt','lt','gte','lte'],
        'dueDate' => ['lk', 'eq', 'ne','gt','lt','gte','lte'],
    ];

    protected $columnMap = [
        'title' => 'title',
        'description' => 'description',
        'isCompleted' => 'is_completed',
        'startDate' => 'start_date',
        'dueDate' => 'due_date',
    ];

    protected $operatorMap = [
        'lk' => 'like',
        'eq' => '=',
        'ne' => '!=',
        'gt' => '>',
        'lt' => '<',
        'gte' => '>=',
        'lte' => '<=',
    ];
}
