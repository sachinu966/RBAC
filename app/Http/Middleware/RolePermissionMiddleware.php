<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RolePermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role, $permission = null)
    {
        $user = Auth::user();
        // Check if the user has the required role
        if (!$user->hasRole($role)) {
            // Redirect or abort with a 403 error if user does not have the role
            return abort(403, 'Access Denied: You do not have the required role');
        }

        // Check if the user has the required permission (if provided)
        if ($permission && !$user->can($permission)) {
            // Redirect or abort with a 403 error if user does not have the permission
            return abort(403, 'Access Denied: You do not have the required permission');
        }

        return $next($request);
    }
}
