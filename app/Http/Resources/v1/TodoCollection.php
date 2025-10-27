<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TodoCollection extends ResourceCollection
{
    
    public function toArray(Request $request): array
    {
        return parent::toArray($request);   // relate the output to TodoResource
    }
}
