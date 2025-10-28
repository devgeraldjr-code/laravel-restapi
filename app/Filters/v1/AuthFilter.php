<?php

namespace App\Filters\v1;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class AuthFilter extends ApiFilter
{
    protected $allowedFilters = [
        'name' => ['lk','eq'],
        'email' => ['lk','eq','ne','gt','lt','gte','lte'],
        
    ];

    protected $columnMap = [
        'name' => 'name',
        'email' => 'email',
    ];

    protected $operatorMap = [
        'lk' => 'like',
        'eq' => '=',
    ];
}
