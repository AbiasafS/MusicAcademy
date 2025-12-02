<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role; // Asegúrate que este "use" esté presente

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validar que se cree bien 
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);
        //Si pasa la validacion, creara el rol 
        Role::create(['name' => $request->name]);

        //Alerta sweetalert 2 
        session()->flash('swal', 
        [
            'icon' => 'success',
            'title' => 'Rol creado exitosamente',
            'timer' => 3000,
            'text' => 'El rol ha sido creado correctamente.',
        
        ]);
        
        //Redireccionar a la vista de roles
        return redirect()->route('admin.roles.index')->with('success', 'Rol created succesfully.');
    }

    /**
     * Display the specified resource.
     */
    //  CORREGIDO  
    public function show(string $id) // <-- Aquí estaba el error "high"
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role) // <-- Corregido para Route Model Binding
    {
        // Pasamos la variable $role a la vista
        return view('admin.roles.edit', compact('role'));

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


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role) // <-- Corregido para Route Model Binding
    {
        //validar que se edite bien 
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id
        ]);
        // 2. Comprobar si el nombre realmente cambió
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role) // <-- Corregido para Route Model Binding
    {
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