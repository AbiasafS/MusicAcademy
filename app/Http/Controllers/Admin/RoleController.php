<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.roles.index');
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        Role::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol creado correctamente');
    }


    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => "required|unique:roles,name,{$role->id}"
        ]);

        $role->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol actualizado correctamente');
    }


    public function destroy(Role $role)
    {
        // PROTECCIÓN: Lista de nombres de roles que NO se pueden borrar
        // Asegúrate de escribir los nombres EXACTAMENTE como están en tu base de datos
        $rolesProtegidos = ['Admin', 'Instructor', 'Student']; 

        if (in_array($role->name, $rolesProtegidos)) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'No es permitido eliminar los roles principales del sistema.');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol eliminado correctamente');
    }
}