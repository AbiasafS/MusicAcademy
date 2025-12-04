<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role; // 1. Importamos el modelo Role

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }
    public function show(User $user)
    {
        // 1. "load('courses')" precarga la relación para que sea más rápido.
        // 2. Enviamos la variable $user (que ya incluye sus cursos) a la vista.
        $user->load('courses');
        
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        // 2. Enviamos la lista de roles a la vista
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

     public function store(Request $request)
    {
        // validar
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        // crear y asignar a una variable $user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // Asignar el rol predefinido "Estudiante"
        // Nota: Asegúrate de que el rol "Estudiante" exista en tu base de datos
        $user->assignRole('Student');

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario creado correctamente');
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        //proteger los primeros 3 usuarios
        if (in_array($user->id, [1, 2, 3])) {
            return back()->with('error', 'No es permitido modificar los usuarios de demostración.');
        }

        $user->update($request->only('name', 'email'));

        // 3. Sincronizamos los roles del usuario con lo que viene del formulario
        $user->roles()->sync($request->roles ?? []);

        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario actualizado');
    }

    public function destroy(User $user)
    {
        if (in_array($user->id, [1, 2, 3])) {
            return back()->with('error', 'No es permitido eliminar los usuarios de demostración.');
        }

        $user->delete();

        return back()->with('success', 'Usuario eliminado');
    }
}