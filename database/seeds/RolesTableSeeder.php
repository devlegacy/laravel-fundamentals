<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'administrador';
        $role->display_name = 'Administrador';
        $role->save();

        $role = new Role();
        $role->name = 'moderador';
        $role->display_name = 'Moderador';
        $role->save();

        $role = new Role();
        $role->name = 'estudiante';
        $role->display_name = 'Estudiante';
        $role->save();
    }
}
