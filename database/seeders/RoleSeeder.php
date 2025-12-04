<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Roles base
        $role = [
            'Student',
            'Instructor',
            'Admin',
        ];

        // Crear roles si no existen
        foreach ($role as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Asignar el rol Administrador al primer usuario existente
        $admin = User::first();
        if ($admin && !$admin->hasRole('Administrador')) {
            $admin->assignRole('Administrador');
        }
    }
}
