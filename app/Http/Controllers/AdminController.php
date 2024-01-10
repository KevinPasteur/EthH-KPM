<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

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

        $user->role_id = $request->role_id;
        $user->save();


        return back()->with('success', $user->email . " a maintenant le rôle " . $user->role->name . ".");
    }
}
