<?php

namespace App\Http\Controllers\Api\Ver1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\v1\AuthCollection;
use App\Http\Resources\v1\AuthResource;
use App\Filters\v1\AuthFilter;
use App\Http\Requests\v1\StoreAuthRequest;


class AuthController extends Controller
{

    public function index(Request $request)
    {
        $filter = new AuthFilter();
        $filterItems = $filter->transform($request); // [['column', 'operator', 'value']]

        $includeTodo = $request->query('includeTodo');

        $query = User::where($filterItems);

        if ($includeTodo) {
            $query->with('todo');
        }

        $users = $query->paginate();

        return new AuthCollection($users->appends($request->query()));
    }

  
    public function store(StoreAuthRequest $request)
    {
        return new AuthResource(User::create($request->validated()));
    }

   
    public function show(string $id)
    {
        $includeTodo = request()->query('includeTodo');
        $user = User::findOrFail($id);
        
        if ($includeTodo) {
            $user->loadMissing('todo');
        }
        
        return new AuthResource($user);
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