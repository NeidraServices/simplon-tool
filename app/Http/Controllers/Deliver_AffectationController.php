<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deliver_UsersModel;
use App\Models\Deliver_ProjetModel;
use Illuminate\Support\Facades\DB;
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

        if($validator->fails()) return response()->json(["success" => false, "error" => $validator->errors()]);
        $data = $validator->validate();
        
        $projet  = Deliver_ProjetModel::find($validator->validated()['projet_id']);
        $fails   = [];

        foreach($data['users'] as $user => $id){
            $affectation = DB::table('dp_affectations')->where('user_id', $id)->where('projet_id',  $projet->id)->get();
            
            $apprenant      = Deliver_UsersModel::find($id);
            $apprenant_name = $apprenant->name . ' ' . $apprenant->surname;
            
            if(sizeof($affectation) > 0 && $projet['id']) $fails += array_merge($fails, [" l'apprenant $apprenant_name à déjà une affectation sur ce projet"]);
            else{
                DB::table('dp_affectations')->insert(['user_id' => $id, 'projet_id' => $projet->id]);
            }
        }
        
        return response()->json([
            'success' => true,
            'infos'   => $fails,
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
