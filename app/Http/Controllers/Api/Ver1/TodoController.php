<?php

namespace App\Http\Controllers\Api\Ver1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Resources\v1\TodoResource;
use App\Http\Resources\v1\TodoCollection;
use App\Filters\v1\TodoFilter;
use App\Http\Requests\v1\StoreTodoRequest;

class TodoController extends Controller
{
    
    public function index(Request $request)
    {
        $filter = new TodoFilter();
        $filterItems = $filter->transform($request); // [['column', 'operator', 'value']]
        $includeUser = $request->query('includeUser');
        $todos = Todo::where($filterItems)->paginate();

        if ($includeUser) {
            $todo = $todos->with('user')->paginate();
            return new TodoCollection($todo->appends($request->query()));
        }
        return new TodoCollection($todos->appends($request->query()));
    
    }

    public function store(StoreTodoRequest $request)
    {
        return new TodoResource(Todo::create($request->validated()));
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
