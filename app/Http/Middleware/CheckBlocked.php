<?php

namespace App\Http\Middleware;

use Brian2694\Toastr\Facades\Toastr;
use Closure;

class CheckBlocked
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
        if (auth()->check())
        {
            if (auth()->user()->is_approved == 0) {
                $message = 'Your account has been blocked !';
                auth()->logout();

                Toastr::error($message);
                return redirect()->back();
            }
        }
        return $next($request);
    }
}
