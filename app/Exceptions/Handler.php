<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
{
    $this->renderable(function (NotFoundHttpException $e, $request) {
        if ($request->expectsJson()) {
            return response()->json([
                'status' => false,
                'message' => 'الرابط المطلوب غير موجود',
            ], 404);
        }
    });

    $this->renderable(function (ModelNotFoundException $e, $request) {
        if ($request->expectsJson()) {
            return response()->json([
                'status' => false,
                'message' => 'العنصر المطلوب غير موجود في قاعدة البيانات',
            ], 404);
        }
    });

    $this->renderable(function (ValidationException $e, $request) {
        if ($request->expectsJson()) {
            return response()->json([
                'status' => false,
                'message' => 'التحقق من البيانات فشل',
                'errors' => $e->errors(),
            ], 422);
        }
    });

    $this->renderable(function (AuthenticationException $e, $request) {
        if ($request->expectsJson()) {
            return response()->json([
                'status' => false,
                'message' => 'يجب تسجيل الدخول',
            ], 401);
        }
    });

    $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
        if ($request->expectsJson()) {
            return response()->json([
                'status' => false,
                'message' => 'الطريقة غير مسموح بها',
            ], 405);
        }
    });

    $this->renderable(function (\Throwable $e, $request) {
        if ($request->expectsJson()) {
            return response()->json([
                'status' => false,
                'message' => 'حدث خطأ غير متوقع',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    });
}
public function render($request, Throwable $e)
{
    return parent::render($request, $e);
}

    // public function render($request, Throwable $exception)
    // {
    //     if ($request->expectsJson() || $request->is('api/*')) {

    //         // ✅ خطأ التحقق من الصحة (Validation)
    //         if ($exception instanceof ValidationException) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'خطأ في التحقق من البيانات',
    //                 'errors' => $exception->errors(),
    //             ], 422);
    //         }

    //         // ✅ سجل غير موجود
    //         if ($exception instanceof ModelNotFoundException) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'السجل المطلوب غير موجود',
    //             ], 404);
    //         }

    //         // ✅ الرابط غير موجود
    //         if ($exception instanceof NotFoundHttpException) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'الرابط المطلوب غير موجود',
    //             ], 404);
    //         }

    //         // ✅ طريقة HTTP غير مسموح بها
    //         if ($exception instanceof MethodNotAllowedHttpException) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'الطريقة غير مسموح بها لهذا الرابط',
    //             ], 405);
    //         }

    //         // ✅ غير مصرح (عدم تسجيل دخول)
    //         if ($exception instanceof AuthenticationException) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'يجب تسجيل الدخول للوصول إلى هذا المورد',
    //             ], 401);
    //         }

    //         // ✅ غير مصرح (ليس لديك صلاحية)
    //         if ($exception instanceof AuthorizationException) {
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'ليس لديك الصلاحيات الكافية',
    //             ], 403);
    //         }

    //         // ✅ أي استثناء غير متوقع
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'حدث خطأ غير متوقع',
    //             'error' => config('app.debug') ? $exception->getMessage() : null
    //         ], 500);
    //     }

    //     // إذا لم يكن طلب API، استخدم العرض العادي
    //     return parent::render($request, $exception);
    // }
}
