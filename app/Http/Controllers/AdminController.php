<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        $roles = Role::all();
        return view('admin.index', compact('users', 'roles'));
    }

    public function changeRole(Request $request, User $user)
    {
        $anoEmailAuth = $this->anonymizeEmail(Auth::user()->email);

        // An user cannot change his own role if he forces the request
        if ($user->id == auth()->user()->id) {
            return redirect()->route('admin.index')->with('error', 'Vous ne pouvez pas changer votre propre rôle.');
        }

        // Vérifiez le mot de passe
        if (!Hash::check($request->password, auth()->user()->password)) {
            Log::error('Mot de passe incorrect lors d\'un changement de rôle par ' . $anoEmailAuth);
            return redirect()->route('admin.index')->with('error', 'Mot de passe incorrect.');
        }

        $user->role_id = $request->role_id;
        $user->save();

        $anoEmailTarget = $this->anonymizeEmail($user->email);

        Log::info('Rôle changé pour l\'utilisateur : ' . $anoEmailTarget . ' pour ' . $user->role->name . ' par ' . $anoEmailAuth);

        return redirect()->route('admin.index')->with('success', $user->email . " a maintenant le rôle " . $user->role->name . ".");
    }

    public function showConfirmRoleChange(Request $request, User $user)
    {
        return view('admin.confirm-role-change', ['user' => $user, 'role_id' => $request->role_id]);
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
