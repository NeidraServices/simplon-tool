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
        $project_name = ['Miel-pei', 'G-a-o', 'Todo-list'];
        for ($i = 0; $i < 3; $i++) {
            DB::table('dp_projets')->insert([
                'formateur_id' => 1,
                'titre' => $project_name[$i],
                'deadline'      => new \DateTime("now"),
                'description'   => "Projet " . $project_name[$i] . " , une explication assé complete sur le projet, techno utiliser, attente du client...",
                'extrait'       => "Extrait du projet " . $project_name[$i] . ". Juste quelques lignes pour expliquer brievement le projet"    
            ]);

            DB::table('dp_affectations')->insert([
                'user_id' => 3,
                'projet_id' => $i+1,
            ]);

            DB::table('dp_rendus')->insert([
                'site_url' => "lien vers site web",
                'github_url' => "lien vers github",
                'user_id'          => 3,
                'projet_id'          => $i+1,

            ]);

            DB::table('dp_tags')->insert([
                'nom' => "nodejs"
            ]);

            DB::table('dp_tags')->insert([
                'nom' => "laravel"
            ]);

            DB::table('dp_competences')->insert([
                'nom' => "backend"
            ]);
            DB::table('dp_competences')->insert([
                'nom' => "front"
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
