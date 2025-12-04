<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::with('roles')->get(),
        ]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $user->syncRoles($request->roles);
        return redirect()->route('admin.users.index')->with('success', 'Roles actualizados correctamente');
    }
}
