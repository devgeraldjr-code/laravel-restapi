<?php

namespace App\Http\Controllers\Api\Ver1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Resources\v1\TodoResource;
use App\Http\Resources\v1\TodoCollection;
use App\Filters\v1\TodoFilter;

class TodoController extends Controller
{
    
    public function index(Request $request)
    {
        $filter = new TodoFilter();
        $queryItems = $filter->transform($request); // [['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            return new TodoCollection(Todo::paginate());
        }
        $todo = Todo::where($queryItems)->paginate();
        return new TodoCollection($todo->appends($request->query()));
    
    }

    public function store(string $id)
    {
    }

    public function show(string $id)
    {
        $todo = Todo::findOrFail($id);
        return new TodoResource($todo);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
