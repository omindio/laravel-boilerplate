<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Shared\Infrastructure\Persistence\Eloquent\Model\UserModel;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = UserModel::create([
            'name' => 'Admin User',
            'surname' => 'Surname Admin User',
            'email' => 'admin@omind.io', // Cambia este correo
            'password' => Hash::make('12345678') // Cambia la contraseña
        ]);

        // Asignar el rol admin al usuario
        $admin->assignRole('admin');
    }
}
