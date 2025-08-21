<?php

use App\Helpers\LogHelper;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
         $middleware->appendToGroup('api', [
        \Illuminate\Http\Middleware\HandleCors::class,
    ]);
        $middleware->alias([
        'language' => \App\Http\Middleware\Lacalization::class,
    ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
         $exceptions->shouldRenderJsonWhen(function ($request, Throwable $e) {
        return $request->expectsJson() || $request->is('api/*');
    });

    $exceptions->renderable(function (Throwable $exception, $request) {

        $errorMap = [
            ValidationException::class => [
                'status'  => false,
                'message' => 'خطأ في التحقق من البيانات',
                'code'    => 422,
                'extra'   => fn($e) => ['errors' => $e->errors()]
            ],
            ModelNotFoundException::class => [
                'status'  => false,
                'message' => 'السجل المطلوب غير موجود',
                'code'    => 404
            ],
            NotFoundHttpException::class => [
                'status'  => false,
                'message' => 'الرابط المطلوب غير موجود',
                'code'    => 404
            ],
            MethodNotAllowedHttpException::class => [
                'status'  => false,
                'message' => 'الطريقة غير مسموح بها لهذا الرابط',
                'code'    => 405
            ],
            AuthenticationException::class => [
                'status'  => false,
                'message' => 'يجب تسجيل الدخول للوصول إلى هذا المورد',
                'code'    => 401
            ],
            AuthorizationException::class => [
                'status'  => false,
                'message' => 'ليس لديك الصلاحيات الكافية',
                'code'    => 403
            ],
        ];

        foreach ($errorMap as $type => $config) {
            if ($exception instanceof $type) {
                //register error in database
                  LogHelper::event('error', $config['message'], [
            'exception' => get_class($exception),
            'url'       => $request->fullUrl(),
            'method'    => $request->method(),
            'ip'        => $request->ip(),
            'input'     => $request->all(),
        ]);
                $response = [
                    'status'  => $config['status'],
                    'message' => $config['message'],
                ];

                if (isset($config['extra']) && is_callable($config['extra'])) {
                    $response = array_merge($response, $config['extra']($exception));
                }

                return response()->json($response, $config['code']);
            }
        }

        // تسجيل الخطأ باستخدام LogHelper
      

        return response()->json([
            'status'  => false,
            'message' => 'حدث خطأ غير متوقع',
            'error'   => config('app.debug') ? $exception->getMessage() : null
        ], 500);
    });

    })->create();
