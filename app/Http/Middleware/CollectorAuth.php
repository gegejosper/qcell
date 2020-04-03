<?php

namespace App\Http\Middleware;

use Closure;

class CollectorAuth
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
        if(Auth::check()){
            if(Auth::user()->usertype == 'collector'){       
                return $next($request);
            }
            else {
                return redirect('/');
            }
        }
        return redirect('/');
    }
}
