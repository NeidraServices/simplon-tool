<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Deliver_ProjetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Deliver_AffectationSeeder::class
        ]);

        for ($i = 1; $i < 4; $i++) {
            DB::table('dp_projets')->insert([
                'formateur_id' => 1,
                'titre' => Str::random(6),
                'deadline'          => new \DateTime("now"),
                'image'          => "https://ma.ambafrance.org/IMG/arton11404.png?1565272504",
                'description'        =>"Projet " . $i . " ayant pour but de travailler la coordination dans un projet d'équipe",
            ]);
        }
    }
}
