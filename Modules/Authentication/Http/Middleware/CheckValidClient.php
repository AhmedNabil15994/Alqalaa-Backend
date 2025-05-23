<?php

namespace Modules\Authentication\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckValidClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth('client')->user()->status == 0 || auth('client')->user()->is_judging == 1){
            auth('client')->logout();
            return redirect(route('client.login'));
        }
        return $next($request);
    }
}
