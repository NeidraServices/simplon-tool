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
        for ($i=1; $i < 5; $i++) { 
            $data = new EvalSondageLines();
            $data->sondage_id  = 1;
            $data->langage_id  = $i;
            $data->skill_id    = $i;
            $data->save();
        }

        for ($i=1; $i < 5; $i++) { 
            $data2 = new EvalSondageLines();
            $data2->sondage_id  = 1;
            $data2->skill_id    = $i;
            $data2->save();
        }


    }
}
