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
 * @OA\Get(
 *     path="/api/users",
 *     summary="جلب كل المستخدمين",
 *     tags={"Users"},
 *     @OA\Response(response=200, description="نجاح العملية", @OA\JsonContent(ref="#/components/schemas/UserResponse"))
 * )
 */
    // ✅ List all users (admin only)
  public function index()
    {   $users = User::with('roles')->get();
        $message=$users->isEmpty()?'message.users_empty':'message.user_index';
        return $this->successResponse(  UserResource::collection($users), __($message), 200) ;
    }
    /**
 * @OA\Get(
 *     path="/api/users/{id}",
 *     summary="عرض مستخدم واحد",
 *     tags={"Users"},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="نجاح العملية", @OA\JsonContent(ref="#/components/schemas/UserResponse")),
 *     @OA\Response(response=404, description="غير موجود")
 * )
 */
    // ✅ Show one user by ID
    public function show(User $user)
    {
        $user->loadMissing('roles');
        return $this->successResponse(new UserResource($user) , __('message.user_show'),200);
    }   
    
/**
 * @OA\Post(
 *     path="/api/users",
 *     summary="إنشاء مستخدم جديد",
 *     tags={"Users"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name","email","phone","password"},
 *             @OA\Property(property="name", type="string", example="Ahmed"),
 *             @OA\Property(property="email", type="string", example="user@example.com"),
 *             @OA\Property(property="phone", type="integer", example=77234566),
 *             @OA\Property(property="password", type="string", example="12345678")
 *         )
 *     ),
 *     @OA\Response(response=201, description="تم الإنشاء", @OA\JsonContent(ref="#/components/schemas/UserResponse"))
 * )
 */
    // ✅ Create a new user (admin only)
    public function store(UserRequest $request)
    {   
        $validatedData = $request->validated();
          $user = $this->userService->register($validatedData);
        
    
        // $roleIds = $request->input('role_ids', [Role::where('name', 'user')->value('id')]);
       
        return $this->successResponse(new UserResource($user) ,__('message.user_store') ,201);
    }
   /**
 * @OA\Put(
 *     path="/api/users/{id}",
 *     summary="تحديث مستخدم",
 *     tags={"Users"},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Ahmed Updated"),
 *             @OA\Property(property="email", type="string", example="updated@example.com")
 *         )
 *     ),
 *     @OA\Response(response=200, description="تم التحديث", @OA\JsonContent(ref="#/components/schemas/UserResponse")),
 *     @OA\Response(response=404, description="غير موجود")
 * )
 */
    // ✅ Update a user (admin only)
    public function update(UserRequest $request, User $user)
    {
        $validatedData = $request->validated();
       
        $user = $this->userService->update($user, $validatedData);
       
        return $this->successResponse($user, __('message.user_update'), 200);
    }
    /**
 * @OA\Delete(
 *     path="/api/users/{id}",
 *     summary="حذف مستخدم",
 *     tags={"Users"},
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="تم الحذف"),
 *     @OA\Response(response=404, description="غير موجود")
 * )
 */
    // ✅ Delete a user (admin only)
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
