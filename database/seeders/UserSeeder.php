<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => 1,
                'name' => 'admin',
                'surname' => 'admin',
                'email' => 'admin@simplonapp.re',
                'password' => Hash::make('password'),
                'verified_at' => now(),
                'role_id' => 1,
                'promotion_id' => null,
            ],
            [
                'id' => 2,
                'name' => 'CHIVET',
                'surname' => 'Adrien',
                'email' => 'adrien@simplonapp.re',
                'password' => Hash::make('password'),
                'verified_at' => now(),
                'role_id' => 2,
                'promotion_id' => null,

            ],
            [
                'id' => 3,
                'name' => 'LADERVAL',
                'surname' => 'Bruno',
                'email' => 'bruno@simplonapp.re',
                'password' => Hash::make('password'),
                'verified_at' => now(),
                'role_id' => 2,
                'promotion_id' => null,
            ],
            [
                'id' => 4,
                'name' => 'ABRADOR',
                'surname' => 'Daryl',
                'email' => 'daryl@simplonapp.re',
                'password' => Hash::make('password'),
                'verified_at' => now(),
                'role_id' => 3,
                'promotion_id' => 1,
            ],
            [
                'id' => 5,
                'name' => 'DIJOUX',
                'surname' => 'Matthias',
                'email' => 'matthias@simplonapp.re',
                'password' => Hash::make('password'),
                'verified_at' => now(),
                'role_id' => 3,
                'promotion_id' => 1,
            ],
            [
                'id' => 6,
                'name' => 'ETHEVE',
                'surname' => 'Florent',
                'email' => 'florent@simplonapp.re',
                'password' => Hash::make('password'),
                'verified_at' => now(),
                'role_id' => 3,
                'promotion_id' => 1,
            ],
            [
                'id' => 7,
                'name' => 'O\'CONNOR',
                'surname' => 'Morgan',
                'email' => 'morgan@simplonapp.re',
                'password' => Hash::make('password'),
                'verified_at' => now(),
                'role_id' => 3,
                'promotion_id' => 1,
            ],
            [
                'id' => 8,
                'name' => 'BARO',
                'surname' => 'Cedrick',
                'email' => 'cedrick@simplonapp.re',
                'password' => Hash::make('password'),
                'verified_at' => now(),
                'role_id' => 3,
                'promotion_id' => 1,
            ],
            [
                'id' => 9,
                'name' => 'BARRET',
                'surname' => 'Alison',
                'email' => 'alison@simplonapp.re',
                'password' => Hash::make('password'),
                'verified_at' => now(),
                'role_id' => 3,
                'promotion_id' => 1,
            ],
            [
                'id' => 10,
                'name' => 'FAUSTINO',
                'surname' => 'Anne-Sophie',
                'email' => 'anne-sophie@simplonapp.re',
                'password' => Hash::make('password'),
                'verified_at' => now(),
                'role_id' => 3,
                'promotion_id' => 1,
            ],
            [
                'id' => 11,
                'name' => 'LEVENEUR',
                'surname' => 'Lucas',
                'email' => 'lucas@simplonapp.re',
                'password' => Hash::make('password'),
                'verified_at' => now(),
                'role_id' => 3,
                'promotion_id' => 2,
            ],
            [
                'id' => 12,
                'name' => 'JULIENNE',
                'surname' => 'Benjamin',
                'email' => 'benjamin@simplonapp.re',
                'password' => Hash::make('password'),
                'verified_at' => now(),
                'role_id' => 3,
                'promotion_id' => 1,

            ],
        ];

        DB::table('users')->insert(
            $users
        );
    }
}
