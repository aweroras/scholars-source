<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!$user || !$this->userHasRole($user, $roles)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }

    private function userHasRole($user, $roles)
    {
        return in_array($user->roles, $roles);
    }
}
