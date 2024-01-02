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
        $user->role_id = $request->role_id;
        $user->save();

        return back();
    }
}
