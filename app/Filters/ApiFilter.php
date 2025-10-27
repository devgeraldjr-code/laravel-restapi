<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter
{
    protected $allowedFilters = [];
    protected $columnMap = [];
    protected $operatorMap = [];

    public function transform(Request $request)
    {
        $eloquentQuery = [];

        foreach ($this->allowedFilters as $param => $operators) {
            $query = $request->query($param);

            if (!isset($query)) {
                continue;
            }
            

            $column = $this->columnMap[$param] ?? $param;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $value = $query[$operator];

                    if ($this->operatorMap[$operator] === 'like') {
                        $value = "%{$value}%";
                    }
                    $eloquentQuery[] = [$column, $this->operatorMap[$operator], $value];
                }
            }
        }

        return $eloquentQuery;
    }
}
