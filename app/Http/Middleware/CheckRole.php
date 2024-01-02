<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) return redirect('login');

        foreach ($roles as $role) {
            // Vérifie si l'utilisateur a l'un des rôles autorisés
            if (Auth::user()->role->name == $role) {
                return $next($request);
            }
        }

        return redirect('/'); // Rediriger si aucun des rôles ne correspond
    }
}
