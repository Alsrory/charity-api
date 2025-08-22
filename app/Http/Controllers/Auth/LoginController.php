<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Auth"},
     *     summary="تسجيل الدخول",
     *     description="إرجاع token عند تسجيل الدخول بنجاح",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="12345678")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="تم تسجيل الدخول بنجاح",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="1|ABCD1234...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="بيانات الدخول غير صحيحة"
     *     )
     * )
     */
     public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
       
        if (Auth::attempt($credentials)) {
           $token = $request->user()->createToken("auth-token");

    return ['token' => $token->plainTextToken];
        }
        return response()->json([
            'message' => 'Unauthorized',
        ], 401);
      }
}
