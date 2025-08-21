<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Bool_;
use Symfony\Component\HttpFoundation\Response;

class Is_Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next): Response
{    
    // if(auth()->check()){
    //   auth()->user()->hasRole('admin');
    // }
    return $next($request);
}

}
