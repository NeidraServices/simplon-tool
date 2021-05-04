<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvalReferentielSeeder extends Seeder
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
                'description' => "Concevoir et développer des composants d'interface utilisateur en intégrant les recommandations de sécurité"
            ],
            [
                'id' => 2,
                'description' => "Concevoir et développer la persistance des données en intégrant les recommandations de sécurité"
            ],
            [
                'id' => 3,
                'description' => "Concevoir et développer une application multicouche répartie en intégrant les recommandations de sécurité"
            ],
        ];
        DB::table('eval_referentiels')->insert(
            $array
        );
    }
}
