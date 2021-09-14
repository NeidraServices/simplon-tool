<?php

namespace Database\Seeders;

use App\Models\EvalPromotion;
use App\Models\EvalReferentiel;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create("fr_FR");

        $this->call([
            RoleSeeder::class,
            EvalLangageSeeder::class,
            EvalReferentielSeeder::class,
            EvalSkillSeeder::class,
        ]);

        EvalPromotion::create([
            "name" => "CDA 2020"
        ]);

        EvalPromotion::create([
            "name" => "DWWM 2020"
        ]);


        $this->call([
            UserSeeder::class,
            Deliver_ProjetSeeder::class,
            MdCategorySeeder::class,
            MarkdownSeeder::class
        ]);
    }
}