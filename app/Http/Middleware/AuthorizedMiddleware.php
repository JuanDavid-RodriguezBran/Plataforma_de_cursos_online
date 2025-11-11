<?php

namespace App\Http\Middleware;

use App\Helpers\RoleHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthorizedMiddleware
{
    public function handle(Request $request, Closure $next, $permission = null): Response
    {
        // Sin sesión → redirige al login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Valida permiso específico
        if (!empty($permission) && !RoleHelper::isAuthorized($permission)) {
            abort(403, 'No tiene autorización para acceder a esta sección');
        }

        return $next($request);
    }
}
