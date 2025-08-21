<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Lacalization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next): Response
{    
    $lang = strtolower(trim($request->header('lang', 'en'))); // default to 'en' if not provided
    $supportedLocales = ['en', 'ar'];

    if (!in_array($lang, $supportedLocales)) {
        $lang = 'en'; // fallback to default language
    }

    app()->setLocale($lang);

    return $next($request);
}

}
