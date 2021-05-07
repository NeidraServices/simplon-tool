<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Markdown_Contribution;

class Md_ContributionController extends Controller
{
    //
    public function create(Request $request,$id){
        
        $contribution               =   new Markdown_Contribution;
        $contribution->user_id      =   Auth::id();
        $contribution->markdown_id  =   $id;
        $contribution->active       =   0;
        $contribution->save();
        return response()->json([
            "success" => true,
            "message" => "Demande de contribution envoyé",
        ]);
    }
    public function acceptContributor(Request $request,$id){
        $contribution=Markdown_Contribution::find($id);
        $contribution->active=1;
        $contribution->save();
        return response()->json([
            "success" => true,
            "message" => "Demande de contribution accepter",
        ]);
    }
    public function declineContributor(Request $request,$id){
        $contribution=Markdown_Contribution::find($id);
        $contribution->delete();
        return response()->json([
            "success" => true,
            "message" => "Demande de contribution refuser",
        ]);
    }
}
