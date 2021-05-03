<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleArray = ['admin', 'formateur', 'apprenant'];

        for ($i=0; $i < count($roleArray); $i++) { 
            $role = new Role();
            $role->label = $roleArray[$i];
            $role->save();
        }
    }
}
