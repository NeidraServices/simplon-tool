<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EvalLangageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            [
                "id" => 1,
                "image"=>"langages/flutter.png",
                "name"=>"Flutter"
            ],
            [
                "id" => 2,
                "image"=>"langages/kotlin.png",
                "name"=>"Kotlin"
            ],
            [
                "id" => 3,
                "image"=>"langages/laravel.png",
                "name"=>"Laravel"
            ],
            [
                "id" => 4,
                "image"=>"langages/nodejs.png",
                "name"=>"Node JS"
            ],
            [
                "id" => 5,
                "image"=>"langages/symfony.png",
                "name"=>"Symfony"
            ],
            [
                "id" => 6,
                "image"=>"langages/vue.png",
                "name"=>"Vue JS"
            ],
        ];

        DB::table('eval_langages')->insert(
            $array
        );
    }
    }
}
