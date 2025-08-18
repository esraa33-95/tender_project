<?php

namespace App\Http\Middleware;

use Closure;


class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, \Closure $next)
{
    $user = auth()->user();

    if ($user && $user->user_type === 1) 
    {
          return $next($request);
      
    }

    return response()->json(['message' => 'Unauthorized. admins only can do this'], 403);
}

}
