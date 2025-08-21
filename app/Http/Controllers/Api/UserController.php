<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResouce;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use App\Trait\ResponseTrait;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class UserController extends Controller
{   use ResponseTrait;
     public $userService;
    public function __construct(UserService $userService)
    {
     
        // $this->middleware('auth:sanctum');
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
  public function index()
    {   $users = User::with('roles')->get();
        $message=$users->isEmpty()?'message.users_empty':'message.user_index';
        return $this->successResponse(  UserResource::collection($users), __($message), 200) ;
    }
    public function show(User $user)
    {
        $user->loadMissing('roles');
        return $this->successResponse(new UserResource($user) , __('message.user_show'),200);
    }   
    public function store(UserRequest $request)
    {   
        $validatedData = $request->validated();
          $user = $this->userService->register($validatedData);
        
    
        // $roleIds = $request->input('role_ids', [Role::where('name', 'user')->value('id')]);
       
        return $this->successResponse(new UserResource($user) ,__('message.user_store') ,201);
    }
    /**
     * Update user data (without modifying permissions).
     * Dedicated to regular users or administrators.
     * Permissions are modified via RoleController.
     */
    public function update(UserRequest $request, User $user)
    {
        $validatedData = $request->validated();
       
        $user = $this->userService->update($user, $validatedData);
       
        return $this->successResponse($user, __('message.user_update'), 200);
    }
    public function destroy(User $user)
    {
        $user->delete();
        return $this->successResponse(null, __('message.user_destroy'), 204);   
    
    
    }


    public function userContributions(User $user)
    {    
        $user->loadMissing('contributions'); // Eager load the 'contributions' relationship
         $contributions = $user->contributions; 
       $message=$contributions->isEmpty()?'message.user_not_contributed' :'message.user_contributed';// Assuming you have a 'contributions' relationship in the User model
        return $this->successResponse($contributions, __($message), 200);
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        if (!$query) {
            return $this->errorResponse(__('message.user_search_empty'), 400);
        }

        $users = User::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->get();

        if ($users->isEmpty()) {
            return $this->errorResponse(__('message.user_search_not_found'), 404);
        }

        return $this->successResponse($users, __('message.user_search_success'), 200);
    }
   
}
