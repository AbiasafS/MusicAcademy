<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesSeeder extends Seeder
{
    public function run()
    {
        // Roles base
        $roles = [
            'Estudiante',
            'Instructor',
            'Administrador',
        ];

        // Crear roles si no existen
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Asignar el rol Administrador al primer usuario existente
        $admin = User::first();
        if ($admin && !$admin->hasRole('Administrador')) {
            $admin->assignRole('Administrador');
        }
    }
}
