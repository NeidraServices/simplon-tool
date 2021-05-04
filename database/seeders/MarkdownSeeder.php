<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MarkdownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('md_categories')->insert([
            'name'          => '162010718537309748.md',
            'user_id'       => 1,
            'md_categories' =>2,
            'active'        =>0,
        ]);
        DB::table('md_categories')->insert([
            'name'          => '1620115757294986926.md',
            'user_id'       => 1,
            'md_categories' =>3,
            'active'        =>1,
        ]);
        DB::table('md_categories')->insert([
            'name'          => '16201156721477719235.md',
            'user_id'       => 3,
            'md_categories' =>1,
            'active'        =>0,
        ]);
    }
}
