<?php

namespace App\Http\Controllers;

use App\Models\Deliver_ProjetModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Deliver_TagModel;
class Deliver_TagController extends Controller
{
    //
    public function ajout(Request $req)
    {
        $data=Validator::make($req->all(),["nom"=>"required|String"])->validate();

        Deliver_TagModel::create($data);

    }

    public function relierProjet(Request $req){

        $data=Validator::make($req->all(),["tag_id"=>"required","projet_id"=>"required"])->validate();

        $tag=Deliver_TagModel::find($data["tag_id"]);
        $projet=Deliver_ProjetModel::find($data["projet_id"]);

        $tag->projets()->attach($tag["id"],["projet_id"=>$projet["id"] ]);

    }

    public function delierProjet(Request $req){

        $data=Validator::make($req->all(),["tag_id"=>"required","projet_id"=>"required"])->validate();

        $tags=Deliver_TagModel::find($data["tag_id"]);
        $projet=Deliver_ProjetModel::find($data["projet_id"]);

        $tags->projets()->detach($projet["id"]);
    }

}
