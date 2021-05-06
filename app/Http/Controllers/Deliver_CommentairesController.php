<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deliver_CommentairesModel;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationsCommentaires;
use App\Mail\NotificationsReponse;
use App\Models\Deliver_ProjetModel;
use App\Models\User;

class Deliver_CommentairesController extends Controller
{
    //

    public function liste(){
        $com = Deliver_CommentairesModel::with("reponses")->where("commentaire_id", null)->where("projet_id", 1)->get();
        return $com;

    }

    public function  ajout(Request $req){

        $validator=Validator::make($req->all(),["projet_id"=>"required","text"=>"required|String"]);

        if($validator->fails()){ 
            return response()->json(["success" => false, "error" => $validator->errors()]);
        }
        $data=$validator->validate();
        $user=User::find(1);
        $projet=Deliver_ProjetModel::find($data["projet_id"]);

        //envoie au formateur  une notification
        Mail::to($user->email)
        ->send(new NotificationsCommentaires($user->name,$user->surname,$projet["titre"] ) );

        Deliver_CommentairesModel::create([
            "text"=>$data["text"],
            "projet_id"=>$data["projet_id"],
            "user_id"=>3
        ]);
        return response()->json(['success' => true]);
    }

    public function repondre(Request  $req){

        $validator=Validator::make($req->all(),["projet_id"=>"required","text"=>"required|String","commentaire_id"=>"required"]);

        if($validator->fails()) {
            return response()->json(["success"=>false,"error"=>$validator->errors()]);
        }

        $data=$validator->validate();

        $user=User::find(1);
        $projet=Deliver_ProjetModel::find($data["projet_id"]);
        $com = Deliver_CommentairesModel::with("users")->where("id", $data["commentaire_id"])->get();

        //envoie au formateur  une notification
        Mail::to($user->email)
        ->send(new NotificationsCommentaires($user->name,$user->surname,$projet["titre"] ) );

        //envoie à l'auteur du commentaire une notification de la réponse
        Mail::to($com[0]["users"]["email"] )
        ->send(new NotificationsReponse($user->name,$user->surname,$com ) );

        Deliver_CommentairesModel::create([
            "text"=>$data["text"],
            "projet_id"=>$data["projet_id"],
            "user_id"=>3,
            "commentaire_id"=>$data["commentaire_id"]
        ]);

        return response()->json(['success' => true]);
    }
}
