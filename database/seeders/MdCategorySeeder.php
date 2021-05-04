<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MdCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('md_categories')->insert([
            'name' => 'Web',
        ]);
        DB::table('md_categories')->insert([
            'name' => 'Securité',
        ]);
        DB::table('md_categories')->insert([
            'name' => 'Hardware',
        ]);
        DB::table('md_categories')->insert([
            'name' => 'Réseau',
        ]);
    }
}
