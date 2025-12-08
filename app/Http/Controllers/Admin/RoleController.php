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

        //SWEETALERT
        session()->flash('swal', 
        [
            'icon' => 'success',
            'title' => 'Rol creado exitosamente',
            'timer' => 3000,
            'text' => 'El rol ha sido creado correctamente.',
        
        ]);
        return redirect()->route('admin.roles.index')
            ->with('success', 'Rol creado correctamente');
    }


    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));

         if($role->id <=4){
            //Alerta sweetalert 2
            session()->flash('swal', 
            [
                'icon' => 'error',
                'title' => 'No se puede editar este rol',
                'timer' => 3000,
                'text' => 'Este rol es esencial para el sistema y no puede ser editado.',
            
            ]);
            //Redireccionar a la vista de roles
            return redirect()->route('admin.roles.index');
        }
    }


    public function update(Request $request, Role $role)
    {
        //restringir los primeros 4 roles fijos
        if($role->id <=4){
            //Alerta sweetalert 2
            session()->flash('swal', 
            [
                'icon' => 'error',
                'title' => 'No se puede editar este rol',
                'timer' => 3000,
                'text' => 'Este rol es esencial para el sistema y no puede ser editado.',
            
            ]);
            //Redireccionar a la vista de roles
            return redirect()->route('admin.roles.index');
        }
        $request->validate([
            'name' => "required|unique:roles,name,{$role->id}"
        ]);

        if ($role->name === $request->name) {
            
            // --- SI NO HAY CAMBIOS ---
            
            // 3a. Manda la alerta de "información"
            session()->flash('swal', [
                'icon'  => 'info',
                'title' => 'Sin cambios',
                'text'  => 'No se detectaron modificaciones. Realiza un cambio para actualizar.',
                'timer' => 3500,
            ]);

            // 3b. Redirige almismo lugar
            return redirect()->route('admin.roles.edit', $role);
        }
        //Si pasa la validacion, editara el rol 
        $role->update(['name' => $request->name]);

        


        //Alerta sweetalert 2 
        session()->flash('swal', 
        [
            'icon' => 'success',
            'title' => 'Rol actualizado exitosamente',
            'timer' => 3000,
            'text' => 'El rol ha sido actualizado correctamente.',
        
        ]);
        
        //Redireccionar a la vista de roles
        return redirect()->route('admin.roles.index', $role);
    }
    


    public function destroy(Role $role)
    {
        //confirmacion antes de eliminar el rol
        

        //restringir los primeros 4 roles fijos
        if($role->id <=4){
            //Alerta sweetalert 2
            session()->flash('swal', 
            [
                'icon' => 'error',
                'title' => 'No se puede eliminar este rol',
                'timer' => 3000,
                'text' => 'Este rol es esencial para el sistema y no puede ser eliminado.',
            
            ]);
            //Redireccionar a la vista de roles
            return redirect()->route('admin.roles.index');
        }
        //confirmacion antes de eliminar el rol
        

        //borrar el elemento
        $role->delete();

        //Alerta sweetalert 2
        session()->flash('swal', 
        [
            'icon' => 'success',
            'title' => 'Rol eliminado exitosamente',
            'timer' => 3000,
            'text' => 'El rol ha sido eliminado correctamente.',
        
        ]);
        //Redireccionar a la vista de roles
        return redirect()->route('admin.roles.index');

    }
} 
