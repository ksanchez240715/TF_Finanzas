<?php

use App\Role;
use App\Models\RoleUserModel;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $userRole = Role::where('name', '=', 'Administrador')->first();
        $newUser = User::create([
            'name' => 'Kevin Joel',
            'paternalSurname' => 'Sánchez',
            'maternalSurname' => 'Caparachin',
            'dni' => '75923651',
            'username' => 'ksanchez',
            'email' => 'ksanchez240715@gmail.com',
            'password' => bcrypt('Ksanchez.1109'),
            'email_verified_at' => Carbon::now("America/Lima"),
        ]);
        RoleUserModel::create([
            'role_id' => $userRole->id,
            'user_id' => $newUser->id,
        ]);


        $userRole = Role::where('name', '=', 'Administrador')->first();
        $newUser = User::create([
            'name' => 'José Martín ',
            'paternalSurname' => 'Senmache',
            'maternalSurname' => 'Sarmiento',
            'dni' => '11448855',
            'username' => 'jsenmache',
            'email' => 'jsenmache@gmail.com',
            'password' => bcrypt('aleman'),
            'email_verified_at' => Carbon::now("America/Lima"),
        ]);
        RoleUserModel::create([
            'role_id' => $userRole->id,
            'user_id' => $newUser->id,
        ]);



//        $userRole = Role::where('name', '=', 'Vendedor')->first();
//        $newUser = User::create([
//            'name' => 'Personal 2',
//            'paternalSurname' => 'Apellido 1',
//            'maternalSurname' => 'Apellido 2',
//            'dni' => '22448855',
//            'username' => 'vendedor2',
//            'email' => 'vendedor2@hotmail.com',
//            'password' => bcrypt('123'),
//            'email_verified_at' => Carbon::now("America/Lima"),
//        ]);
//        RoleUserModel::create([
//            'role_id' => $userRole->id,
//            'user_id' => $newUser->id,
//        ]);

//        $newUser->attachRole($userRole);
    }
}
