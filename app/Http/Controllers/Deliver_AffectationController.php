<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deliver_UsersModel;
use App\Models\Deliver_ProjetModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class Deliver_AffectationController extends Controller
{
    //
    public function affecter(Request $req){

        $validator=Validator::make($req->all(),[
            "users" => "required",
            "projet_id" => "required"
        ]);


        if($validator->fails()){
            return response()->json(["success" => false, "error" => $validator->errors()]);
        }
        $data = $validator->validate();


//        $projet = Deliver_ProjetModel::whereId($data['projet_id'])->get();
        $projet = Deliver_ProjetModel::whereId($data['projet_id'])->with("users")->get();

        $echecs = [];

        foreach ($data['users'] as $key => $user) {
            $user = Deliver_UsersModel::find($user);

            $user->projets()->attach($user, ["projet_id"=>$data["projet_id"]]);

            //si l'apprenant est déjà affecté au projet
//            $affectation = Deliver_ProjetModel::with("users")->whereHas("users", function($users) use($data, $user){
//                $users->where("user_id", $user)->where("projet_id",$data["projet_id"]);
//            })->get();
//
//
//            if(sizeof($affectation)==0){
//                return $user->projets()->attach($user, ["projet_id"=>$data["projet_id"]]);
//            }else{
//                array_push($echecs, $user->nom . "est d&eacute;j&agrave; affect&eacute; au projet ".$projet["titre"]);
//            }
        }
        return $projet;

        return response()->json([
            'success' => true,
            'message' => "Mise à jour effectuée",
            'echecs' => [
                'status' => (count($echecs) > 0 ? true : false),
                $echecs
            ]
        ]);

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
