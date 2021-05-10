<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $contribution=Markdown_Contribution::where('id',$id)->first();
        $contribution->active=1;
        $contribution->save();
        return response()->json([
            "success" => true,
            "message" => "Demande de contribution accepté",
        ]);
    }
    public function getListContributionRequest(Request $request,$id){
        $contribution = Markdown_Contribution::where(["markdown_id"=>$id, "active"=>0])->get();
        return $contribution;
    }
    public function declineContributor(Request $request,$id){
        $contribution=Markdown_Contribution::where('id',$id)->first();
        $contribution->delete();
        return response()->json([
            "success" => true,
            "message" => "Demande de contribution refusé",
        ]);
    }
}
