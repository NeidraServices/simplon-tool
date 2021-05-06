<?php

namespace App\Http\Controllers;

use App\Models\Deliver_ProjetModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Deliver_TagModel;
class Deliver_TagController extends Controller
{
    //

    public function liste(){
        $tags = Deliver_TagModel::all();
        return response()->json($tags);
    }
    public function ajout(Request $req)
    {
        $validator = Validator::make($req->all(),["nom"=>"required|String"]);
        if($validator->fails()){
            return response()->json([
                "success" => false,
                "error"   => $validator->errors()
            ]);
        }

        $tag_data = $validator->validated();
        Deliver_TagModel::create($tag_data);
        return response()->json([
            "success" => true
        ]);

    }

    public function update(Request $req)
    {
        $validator = Validator::make($req->all(),["id"=>"required","nom"=>"required"]);
        if($validator->fails()){
            return response()->json([
                "success" => false,
                "error"   => $validator->errors()
            ]);
        }

        $tag_data = $validator->validated();
       $tag=Deliver_TagModel::find($tag_data["id"]);
        $tag->nom=$tag_data["nom"];
        $tag->save();
        return response()->json([
            "success" => true
        ]);

    }

    public function delete(Request $req)
    {
        $validator = Validator::make($req->all(),["id"=>"required"]);
        if($validator->fails()){
            return response()->json([
                "success" => false,
                "error"   => $validator->errors()
            ]);
        }

        $tag_data = $validator->validated();
       $tag=Deliver_TagModel::destroy($tag_data["id"]);

        return response()->json([
            "success" => true
        ]);

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
