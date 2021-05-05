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
            'md_category_id'=>2,
            'url'           => '162010718537309748.md',
            'active'        =>0,
            'title'         =>'Architecture PC',
            'description'   =>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut volutpat massa et venenatis fermentum. Pellentesque metus lorem, aliquam sit amet maximus et, scelerisque vel sapien. Nunc dignissim imperdiet dolor, a aliquet nulla convallis vel. Proin ornare quam ut ex posuere, sit amet posuere lorem malesuada.'
        ]);
        DB::table('markdowns')->insert([
            'user_id'       => 1,
            'md_category_id' =>3,
            'url'          => '1620115757294986926.md',
            'active'        =>1,
            'title'         =>'N.A.S',
            'description'   =>' Integer sed metus interdum, semper nisl a, bibendum quam. Duis at sollicitudin sem. Nullam egestas ac tellus et aliquam. Mauris nulla libero, faucibus eu ultricies id, ultricies ac magna. Quisque consectetur vulputate massa. Nunc a mi vel turpis fermentum tincidunt in quis diam.',
        ]);
        DB::table('markdowns')->insert([
            'user_id'       => 3,
            'md_category_id' =>1,
            'url'          => '16201156721477719235.md',
            'active'        =>0,
            'title'         =>'Framework python',
            'description'   =>'Sed felis tellus, fermentum nec malesuada ut, scelerisque in tortor. Nunc imperdiet bibendum mauris. Aenean sollicitudin et leo eget commodo.',
        ]);
    }
}
