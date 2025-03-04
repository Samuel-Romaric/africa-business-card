<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GlobalAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->isGlobalAdmin() ) {
                return $next($request);
            }

            // Si c'est un admin simple, vérifier l'accès aux routes restreintes
            if ($user->role === 'admin') {
                
                // Liste des routes interdites aux admins simples
                $restrictedRoutes = ['admin.users.index'];

                if (in_array($request->route()->getName(), $restrictedRoutes)) {
                    return redirect()->route('admin.dashboard')->with('error', 'Accès interdit.');
                }

                return $next($request);
            }
            return redirect()->route('admin.dashboard')->with('error', 'Accès restreint.');
        }
        return $next($request);
    }
}
