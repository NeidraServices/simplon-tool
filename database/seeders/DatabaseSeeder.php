<?php

namespace Database\Seeders;

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


        $mailArray = ["admin@simplonapp.re", "formateur@simplonapp.re", "apprenant@simplonapp.re"];

        for ($i = 1; $i < 4; $i++) {
            $user = new User();
            $user->name         = $faker->firstName();
            $user->surname      = $faker->lastName();
            $user->email        = $mailArray[$i - 1];
            $user->password     = Hash::make('password');
            $user->verified_at  = now();
            $user->role_id      = $i;
            $user->save();
        }

        
        $this->call([
            EvalSondageSeeder::class,
            EvalSondageLinesSeeder::class,
            Deliver_ProjetSeeder::class,
            MdCategorySeeder::class,
            MarkdownSeeder::class
        ]);
    }
}
