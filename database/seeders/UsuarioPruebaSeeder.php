<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsuarioPruebaSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'encargado@roselab.test'],
            [
                'name' => 'Encargado RoseLab',
                'password' => 'RoseLab2026*',
                'rol' => 'encargado',
            ]
        );

        User::updateOrCreate(
            ['email' => 'estudiante@roselab.test'],
            [
                'name' => 'Estudiante RoseLab',
                'password' => 'RoseLab2026*',
                'rol' => 'estudiante',
            ]
        );
    }
}
