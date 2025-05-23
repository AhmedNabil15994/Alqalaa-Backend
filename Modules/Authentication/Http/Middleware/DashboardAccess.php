<?php

namespace Modules\Authentication\Http\Middleware;

use Closure;
use Auth;

class DashboardAccess
{
    public function handle($request, Closure $next, $guard = null)
    {

        return $next($request);
    }
}
