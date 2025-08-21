<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(UserRequest $request){
        // Validate the request data using UserRequest
        $validatedData = $request->validated();
        $user = User::create($validatedData);
        $role=Role::where('name', 'user')->first(); // Assuming you want to assign the 'user' role
           $user->roles()->attach($role->id);
      
        // Optionally, you can return a response or redirect

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);

    }
  
}
