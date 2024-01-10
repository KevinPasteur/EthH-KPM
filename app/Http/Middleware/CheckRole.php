<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::check() && in_array(Auth::user()->role->name, $roles)) {
            return $next($request);
        }

        if (Auth::user()->role->name == "Désactivé") {
            return redirect('unauthorized')->with('error', 'Vous compte est désactivé, vous ne pouvez pas pour l\'instant utiliser cette partie du site.'); // Rediriger si aucun des rôles ne correspond
        }

        return redirect('unauthorized')->with('error', 'Vous n\'avez pas les autorisations nécessaires pour poursuivre.'); // Rediriger si aucun des rôles ne correspond
    }
}