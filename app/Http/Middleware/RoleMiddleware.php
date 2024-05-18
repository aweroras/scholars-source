<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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



        // Check if user has the required roles
        if (!$user || !$this->userHasRole($user, $roles)) {
            // Flash an error message to the session
            session()->flash('error', 'Unauthorized action.');

            // Redirect back to the previous page
            return Redirect::back()->with('error', 'Unauthorized action.');
        }

        return $next($request);


    }



    private function userHasRole($user, $roles)
    {
        return in_array($user->roles, $roles);
    }
}
