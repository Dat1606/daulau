<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserShow
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
        if ($request->user()->id == $request->route('user')->id)
        {
            return $next($request);
        }
        return redirect()->back()->with('You don\'t have access to this page');
    }
}
