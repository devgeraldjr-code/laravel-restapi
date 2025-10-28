<?php

namespace App\Http\Controllers\Api\Ver1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\v1\AuthCollection;
use App\Http\Resources\v1\AuthResource;
use App\Filters\v1\AuthFilter;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $includeTodo = request()->query('includeTodo');
        $user = User::findOrFail($id);
        
        if ($includeTodo) {
            $user->loadMissing('todo');
        }
        
        return new AuthResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
