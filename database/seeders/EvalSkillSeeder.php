<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvalSkillSeeder extends Seeder
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
                'id' => 1,
                'description' => "Maquetter une application",
                'referentiel_id' => 1
            ],
            [
                'id' => 2,
                'description' => "Développer une interface utilisateur de type desktop",
                'referentiel_id' => 1
            ],
            [
                'id' => 3,
                'description' => "Développer des composants d’accès aux données",
                'referentiel_id' => 1
            ],
            [
                'id' => 4,
                'description' => "Développer la partie front-end d’une interface utilisateur web",
                'referentiel_id' => 1
            ],
            [
                'id' => 5,
                'description' => "Développer la partie back-end d’une interface utilisateur web",
                'referentiel_id' => 1
            ],
            [
                'id' => 6,
                'description' => "Concevoir une base de données",
                'referentiel_id' => 2
            ],
            [
                'id' => 7,
                'description' => "Mettre en place une base de données",
                'referentiel_id' => 2
            ],
            [
                'id' => 8,
                'description' => "Développer des composants dans le langage d’une base de données",
                'referentiel_id' => 2
            ],
            [
                'id' => 9,
                'description' => "Collaborer à la gestion d’un projet informatique et à l’organisation de l’environnement de développement",
                'referentiel_id' => 3
            ],
            [
                'id' => 10,
                'description' => "Concevoir une application",
                'referentiel_id' => 3
            ],
            [
                'id' => 11,
                'description' => "Développer des composants métier",
                'referentiel_id' => 3
            ],
            [
                'id' => 12,
                'description' => "Construire une application organisée en couches",
                'referentiel_id' => 3
            ],
            [
                'id' => 13,
                'description' => "Développer une application mobile",
                'referentiel_id' => 3
            ],
            [
                'id' => 14,
                'description' => "Préparer et exécuter les plans de tests d’une application",
                'referentiel_id' => 3
            ],
            [
                'id' => 15,
                'description' => "Préparer et exécuter le déploiement d’une application",
                'referentiel_id' => 3
            ]
        ];
        DB::table('eval_skills')->insert(
            $array
        );
    }
}
