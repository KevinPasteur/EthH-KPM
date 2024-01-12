<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        // An user cannot change his own role if he forces the request
        if ($user->id == auth()->user()->id) {
            return redirect()->route('admin.index')->with('error', 'Vous ne pouvez pas changer votre propre rôle.');
        }

        // Vérifiez le mot de passe
        if (!Hash::check($request->password, auth()->user()->password)) {
            return redirect()->route('admin.index')->with('error', 'Mot de passe incorrect.');
        }

        $user->role_id = $request->role_id;
        $user->save();


        return redirect()->route('admin.index')->with('success', $user->email . " a maintenant le rôle " . $user->role->name . ".");
    }

    public function showConfirmRoleChange(Request $request, User $user)
    {
        return view('admin.confirm-role-change', ['user' => $user, 'role_id' => $request->role_id]);
    }
}