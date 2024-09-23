<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'david@omind.io', // Cambia este correo
            'password' => Hash::make('1234') // Cambia la contraseña
        ]);

        // Asignar el rol admin al usuario
        $admin->assignRole('admin');
    }
}
