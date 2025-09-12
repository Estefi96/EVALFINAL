<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Crear usuario admin fijo
        User::updateOrCreate(
            [
                'email' => 'admin@ventasfix.cl'
            ],
            [
                'name' => 'admin',
                'email' => 'admin@ventasfix.cl',
                'password' => bcrypt('123'),
                'rut' => '12345678-9',
                'lastname' => 'Administrador'
            ]
        );
    }
}
