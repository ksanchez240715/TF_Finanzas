<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Add Roles
         *
         */
        if (Role::where('name', '=', 'Administrador')->first() === null) {
            Role::create([
                'name'        => 'Administrador',
                'display_name'        => 'ADMINISTRADOR',
                'description' => 'Administrador del negocio'
            ]);
        }

        if (Role::where('name', '=', 'Vendedor')->first() === null) {
            Role::create([
                'name'        => 'Vendedor',
                'display_name'        => 'VENDEDOR',
                'description' => 'Vendedor del negocio'
            ]);
        }

        if (Role::where('name', '=', 'Cliente')->first() === null) {
            Role::create([
                'name'        => 'Cliente',
                'display_name'        => 'CLIENTE',
                'description' => 'Usuario final del sistema'
            ]);
        }

    }
}
