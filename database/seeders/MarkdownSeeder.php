<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        DB::table('markdowns')->insert([
            'user_id'       => 1,
            'md_category_id' =>2,
            'url'          => '162010718537309748.md',
            'active'        =>0,
        ]);
        DB::table('markdowns')->insert([
            'user_id'       => 1,
            'md_category_id' =>3,
            'url'          => '1620115757294986926.md',
            'active'        =>1,
        ]);
        DB::table('markdowns')->insert([
            'user_id'       => 3,
            'md_category_id' =>1,
            'url'          => '16201156721477719235.md',
            'active'        =>0,
        ]);
    }
}
