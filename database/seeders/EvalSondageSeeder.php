<?php

namespace Database\Seeders;

use App\Models\EvalSondage;
use Illuminate\Database\Seeder;

class EvalSondageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $data = new EvalSondage();
        $data->user_id  = 4;
        $data->published = 1;
        $data->accepted = 1;
        $data->name = "Sondage 1";
        $data->save();

        $data2 = new EvalSondage();
        $data2->user_id  = 4;
        $data2->published = 0;
        $data2->accepted = 1;
        $data2->name = "Sondage 2";
        $data2->save();

        $data3 = new EvalSondage();
        $data3->user_id  = 4;
        $data3->published = 1;
        $data3->accepted = 1;
        $data3->name = "Sondage 3";
        $data3->save();
    }
}
