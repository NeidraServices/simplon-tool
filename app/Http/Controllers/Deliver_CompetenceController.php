<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deliver_CompetencesModel;
use App\Models\Deliver_ProjetModel;
class Deliver_CompetenceController extends Controller
{
    //
    public function addCompetence(Request $req){
        $competences=$req->all();
        Deliver_CompetencesModel::create($competences);
    }


    public function relierProjet(Request $req){
        $data=$req->all();
        $competences=Deliver_CompetencesModel::find($data["competence_id"]);
        $projet=Deliver_ProjetModel::find($data["projet_id"]);

        $competences->projets()->attach($competences["id"],["projet_id"=>$projet["id"] ]);
    }

    public function delierProjet(Request $req){
        $data=$req->all();
        $competences=Deliver_CompetencesModel::find($data["competence_id"]);
        $projet=Deliver_ProjetModel::find($data["projet_id"]);

        $competences->projets()->detach($projet["id"]);
    }

}
