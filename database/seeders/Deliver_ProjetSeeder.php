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
        for ($i = 1; $i < 4; $i++) {
            DB::table('dp_projets')->insert([
                'formateur_id' => 1,
                'titre' => Str::random(6),
                'deadline'          => new \DateTime("now"),
                'image'          => "https://ma.ambafrance.org/IMG/arton11404.png?1565272504",
                'description'        =>"Projet " . $i . " ayant pour but de travailler la coordination dans un projet d'équipe",
            ]);

            DB::table('dp_affectations')->insert([
                'user_id' => 3,
                'projet_id' => $i,
            ]);

            DB::table('dp_rendus')->insert([
                'site_url' => "lien vers site web",
                'github_url' => "lien vers github",
                'user_id'          => 3,
                'projet_id'          => $i,

            ]);

            DB::table('dp_medias')->insert([
                'type' => "Choisir un type",
                'lien' => "https://ma.ambafrance.org/IMG/arton11404.png?1565272504",
                'nom'          => "Media " .$i. " pour le projet " .$i,
                'rendu_id'          => 1,
            ]);

        }
    }
}
