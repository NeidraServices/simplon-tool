<?php

namespace App\Http\Controllers;

use App\Models\EvalSondage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StatsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Get data functions
    |--------------------------------------------------------------------------
    */


    /**
     * Get stats for published (or not) sondage
     * 
     * @return \Illuminate\Http\Response
     */

    public function getSondageStats() {
        $userIdAuth = Auth::id();
        $loggedUser = User::whereId($userIdAuth)->first();

        $allSondages = "";
        $publishedSondage = "";
        $notPublishedSondage = "";
        $labels = [];

        if($loggedUser->role_id == 3) {
            $allSondages = EvalSondage::where(['user_id' => $loggedUser->id])->count();
            $publishedSondage    = EvalSondage::where(['published' => 1, 'user_id' => $loggedUser->id])->count();
            $notPublishedSondage = EvalSondage::where(['published' => 0, 'user_id' => $loggedUser->id])->count();
        } else {
            $allSondages         = EvalSondage::all()->count();
            $publishedSondage    = EvalSondage::where(['published' => 1])->count();
            $notPublishedSondage = EvalSondage::where(['published' => 0])->count();
        }

        $labels      = ["Publier", "En attente"];
        $dataArray   = [$publishedSondage, $notPublishedSondage];
        
        return response()->json([
            "labels" => $labels,
            "data"   => $dataArray,
            "total"  => $allSondages,
        ]);
    }
}
