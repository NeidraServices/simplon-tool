<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deliver_UsersModel;
use App\Models\Deliver_ProjetModel;
use Illuminate\Support\Facades\Validator;

class Deliver_AffectationController extends Controller
{
    //
    public function affecter(Request $req){

        $validator=Validator::make($req->all(),["user_id"=>"required","projet_id"=>"required"]);

        if($validator->fails()){ 
            return response()->json(["success" => false, "error" => $validator->errors()]);
        }
        $data=$validator->validate();
        
        $user=Deliver_UsersModel::find($data["user_id"]);
        $projet=Deliver_ProjetModel::find($data["projet_id"]);

        //si l'apprenant est déjà affecté au projet
        $affectation=Deliver_ProjetModel::with("users")->whereHas("users",function($users) use($data){
            $users->where("user_id",$data["user_id"])->where("projet_id",$data["projet_id"]);
        })->get();
       

        if(sizeof($affectation)==0){

       return $user->projets()->attach($data["user_id"],["projet_id"=>$data["projet_id"]]);

        }else{
            return response()->json(["error"=>"cette apprenant est d&eacute;j&agrave; affect&eacute; au projet ".$projet["titre"]]);
        }
    }

    public function supprimerApprenant(Request $req){
        
        $validator=Validator::make($req->all(),["competence_id"=>"required","projet_id"=>"required"]);

        if($validator->fails()){ 
            return response()->json(["success" => false, "error" => $validator->errors()]);
        }

        $data=$validator->validate();

        $user=Deliver_UsersModel::find($data["user_id"]);
        $projet=Deliver_ProjetModel::find($data["projet_id"]);

        $user->projets()->detach($projet["id"]);
        return response()->json(['success' => true]);

    }
}
