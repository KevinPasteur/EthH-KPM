<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            'password_confirmation' => 'required|same:password',
            'g-recaptcha-response' => 'required|recaptcha',
        ]);

        $role =
            DB::collection('roles')
            ->where('name', 'Désactivé')
            ->first();

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role['_id'],
        ]);

        event(new Registered($user));

        Auth::login($user);

        $anoEmailAuth = $this->anonymizeEmail(Auth::user()->email);

        Log::info('Inscription de l\'utilisateur : ' . $anoEmailAuth);

        return redirect(RouteServiceProvider::HOME);
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
