<?php

namespace Database\Seeders;

use App\Models\EvalSondageLines;
use Illuminate\Database\Seeder;

class EvalSondageLinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questionArray = [
            "Etes-vous à l'aise en REACT JS ?", 
            "Etes-vous à l'aise en VUE JS ?", 
            "Préferez-vous le BACKEND ou le FRONTEND ?", 
            "Voulez-vous apprendre d'avantage dans le développmeù", 
            "Avez-vous des remarques concernant la formation ?",
        ];

        /**
         * Seeders sondage 1
         */
        for ($i=1; $i < 5; $i++) { 
            $data = new EvalSondageLines();
            $data->sondage_id   = 1;
            $data->type         = 0;
            $data->langage_id  = $i;
            $data->save();
        }

        for ($i=1; $i < 5; $i++) { 
            $data = new EvalSondageLines();
            $data->sondage_id  = 1;
            $data->type        = 1;
            $data->skill_id   = $i;
            $data->save();
        }


        /**
         * Seeders sondage 2
         */
        for ($i=1; $i < 5; $i++) { 
            $data = new EvalSondageLines();
            $data->sondage_id  = 1;
            $data->type        = 2;
            $data->question    = $questionArray[$i - 1];
            $data->save();
        }


        /**
         * Seeders sondage 3
         */
        for ($i=1; $i < 5; $i++) { 
            $data = new EvalSondageLines();
            $data->sondage_id   = 3;
            $data->type         = 0;
            $data->langage_id  = $i;
            $data->save();
        }

        
        for ($i=1; $i < 5; $i++) { 
            $data = new EvalSondageLines();
            $data->sondage_id  = 3;
            $data->type        = 1;
            $data->skill_id   = $i;
            $data->save();
        }

        for ($i=1; $i < 5; $i++) { 
            $data = new EvalSondageLines();
            $data->sondage_id  = 3;
            $data->type        = 2;
            $data->question    = $questionArray[$i - 1];
            $data->save();
        }
    }
}
