<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                "image" => "flutter.png",
                "name" => "Flutter"
            ],
            [
                "id" => 2,
                "image" => "kotlin.png",
                "name" => "Kotlin"
            ],
            [
                "id" => 3,
                "image" => "laravel.png",
                "name" => "Laravel"
            ],
            [
                "id" => 4,
                "image" => "nodejs.png",
                "name" => "Node JS"
            ],
            [
                "id" => 5,
                "image" => "symfony.png",
                "name" => "Symfony"
            ],
            [
                "id" => 6,
                "image" => "vue.png",
                "name" => "Vue JS"
            ],
        ];

        DB::table('eval_langages')->insert(
            $array
        );
    }
}
