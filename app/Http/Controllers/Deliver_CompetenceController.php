<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deliver_CompetencesModel;
use App\Models\Deliver_ProjetModel;
use Illuminate\Support\Facades\Validator;

class Deliver_CompetenceController extends Controller
{
    //

    public function liste(){
        $data=Deliver_CompetencesModel::all();
        return response()->json($data);
    }

    public function addCompetence(Request $req){
        $validator = Validator::make($req->all(), ['nom' => "required"]);
        if($validator->fails()){ 
            return response()->json(["success" => false, "error" => $validator->errors()]);
        }
        $competences = $validator->validated();
        Deliver_CompetencesModel::create($competences);
        return response()->json(['success' => true]);
    }


    public function relierProjet(Request $req){
       $validator=Validator::make($req->all(),["competence_id"=>"required","projet_id"=>"required"]);

       if($validator->fails()) {
        return response()->json(["success"=>false,"error"=>$validator->errors()]);
         }

        $data=$validator->validate();
        $competences=Deliver_CompetencesModel::find($data["competence_id"]);
        $projet=Deliver_ProjetModel::find($data["projet_id"]);

        $competences->projets()->attach($competences["id"],["projet_id"=>$projet["id"] ]);
        return response()->json(['success' => true]);
    }

    public function delierProjet(Request $req){

        $validator=Validator::make($req->all(),["competence_id"=>"required","projet_id"=>"required"]);

        if($validator->fails()) {
            return response()->json(["success"=>false,"error"=>$validator->errors()]);
        }

        $data=$validator->validate();

        $competences=Deliver_CompetencesModel::find($data["competence_id"]);
        $projet=Deliver_ProjetModel::find($data["projet_id"]);

        $competences->projets()->detach($projet["id"]);
        return response()->json(['success' => true]);
    }

}
