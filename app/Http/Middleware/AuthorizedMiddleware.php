<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\RoleHelper;

class AuthorizedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission = null)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($permission && !RoleHelper::isAuthorized($permission)) {
            abort(403, 'No hay autorización');
        }

        return $next($request);
    }
}
