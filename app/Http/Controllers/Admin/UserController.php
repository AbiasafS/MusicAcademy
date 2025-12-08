<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

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
        $user->load('courses');
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        // Protegemos usuarios demo
        if (in_array($user->id, [1, 2, 3])) {

            session()->flash('swal', [
                'icon'  => 'error',
                'title' => 'No permitido',
                'text'  => 'No se pueden editar usuarios de demostración.',
                'timer' => 3000
            ]);

            return redirect()->route('admin.users.index');
        }

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        // Crear usuario
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // Asignar rol estudiante por defecto
        $user->assignRole('Student');

        // Alerta de éxito
        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Usuario creado',
            'text'  => 'El usuario fue creado correctamente.',
            'timer' => 3000
        ]);

        return redirect()->route('admin.users.index');
    }

    public function update(Request $request, User $user)
    {
        // Usuario demo protegido
        if (in_array($user->id, [1, 2, 3])) {

            session()->flash('swal', [
                'icon'  => 'error',
                'title' => 'Acción no permitida',
                'text'  => 'No se pueden modificar usuarios de demostración.',
                'timer' => 3000
            ]);

            return redirect()->route('admin.users.index');
        }

        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        // Actualizar roles
        $user->roles()->sync($request->roles ?? []);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Usuario actualizado',
            'text'  => 'Los datos del usuario se han actualizado correctamente.',
            'timer' => 3000
        ]);

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        // Usuario demo no se puede borrar
        if (in_array($user->id, [1, 2, 3])) {

            session()->flash('swal', [
                'icon'  => 'error',
                'title' => 'No permitido',
                'text'  => 'No puedes eliminar usuarios de demostración.',
                'timer' => 3000
            ]);

            return redirect()->route('admin.users.index');
        }

        $user->delete();

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Usuario eliminado',
            'text'  => 'El usuario fue eliminado correctamente.',
            'timer' => 3000
        ]);

        return redirect()->route('admin.users.index');
    }
}
