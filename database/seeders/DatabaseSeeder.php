<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    // use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        //llamamos al role seeder
        $this->call(RoleSeeder::class);
        
        //Ejemplo de creación de usuario
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'salazarabiasaf@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $admin->assignRole('Admin');

        $instructor = User::factory()->create([
            'name' => 'Instructor',
            'email' => 'instructor@ejemplo.com',
            'password' => bcrypt('12345678'),
        ]);
        $instructor->assignRole('Instructor');

        $student = User::factory()->create([
            'name' => 'Student',
            'email' => 'st@ejemplo.com',
            'password' => bcrypt('12345678'),
        ]);
        $student->assignRole('Student');

    }
}
