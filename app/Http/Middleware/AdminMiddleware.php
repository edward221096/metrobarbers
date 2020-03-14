<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        if ($request->user() && $request->user()->type != 'Barber' && $request->user()->type != 'Receptionist')
//    {
//        return new Response(view('Unauthorized')->with('role', 'Barber', 'Receptionist'));
//    }
//        return $next($request);
    }
}
