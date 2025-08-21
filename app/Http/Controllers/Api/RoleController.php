<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Models\User;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

class RoleController extends Controller
{use ResponseTrait;
    public function __construct()
    {
        // You can apply middleware here if needed
        // $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$roles=User::with('roles')->get();   // Assuming you have a User model with roles relationship
        $roles=Role::all(); // Fetch all roles
        return $this->successResponse($roles, __('message.role_index'), 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param RoleRequest $request
     * add new roles to the system
     */
    public function store(RoleRequest $request)
    {   
        $role=$request->validated();
        $data=Role::create($role);
        return $this->successResponse($data, __('message.role_store'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {    $role->loadMissing('users'); // Eager load the 'user' relationship
        return $this->successResponse($role, __('message.role_show'), 200);
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(RoleRequest $request, Role $role )
{   $validatData=$request->validated();
   $role->update($validatData);
    return $this->successResponse($role, __('message.role_update'), 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Role $role)
    {
        $role->delete();
        return $this->successResponse(null, __('message.role_destroy'), 204);
    }
}
