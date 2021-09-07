<?php

namespace App\Http\Controllers;

use App\Models\EvalSondage;
use Illuminate\Http\Request;

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
        $allSondages         = EvalSondage::all()->count();
        $publishedSondage    = EvalSondage::where(['published' => 1])->count();
        $notPublishedSondage = EvalSondage::where(['published' => 0])->count();

        $labels      = ["Publier", "Brouillon"];
        $dataArray   = [$publishedSondage, $notPublishedSondage];
        
        return response()->json([
            "labels" => $labels,
            "data"   => $dataArray,
            "total"  => $allSondages,
        ]);
    }
}
