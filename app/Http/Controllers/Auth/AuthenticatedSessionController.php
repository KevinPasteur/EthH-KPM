<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $anoEmailAuth = $this->anonymizeEmail(Auth::user()->email);

        Log::info('Connexion de l\'utilisateur : ' . $anoEmailAuth);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    function anonymizeEmail($email)
    {
        $parts = explode("@", $email);
        if (count($parts) == 2) {
            $name = $parts[0];
            $domain = $parts[1];

            // Masquer une partie du nom
            $nameLength = strlen($name);
            $visibleNameLength = max(1, round($nameLength / 2)); // Garde visible la moitié du nom
            $hiddenName = str_repeat('*', $nameLength - $visibleNameLength);

            return substr($name, 0, $visibleNameLength) . $hiddenName . '@' . $domain;
        }
        return $email; // Retourne l'email original si le format n'est pas valide
    }
}
