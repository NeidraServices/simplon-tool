<?php

namespace App\Http\Controllers;

use App\Http\Resources\EvalSondageFormateurResource;
use Illuminate\Http\Request;
use App\Models\EvalSondage;
use App\Http\Resources\EvalSondageResource;
use App\Models\EvalSondageLines;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EvalSondageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Get data functions
    |--------------------------------------------------------------------------
    */


    /**
     * Retrieve all (formateur)
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDataAll() {
        $sondages = EvalSondage::all();
        return EvalSondageFormateurResource::collection($sondages);
    }


    /**
     * Retrieve all (connected learners)
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDataSpecific() {
        $sondages = EvalSondage::where(['user_id' => Auth::id(), 'published' => 1, 'accepted' => 1])->get();
        return EvalSondageResource::collection($sondages);
    }

    /*
    |--------------------------------------------------------------------------
    | Create data functions
    |--------------------------------------------------------------------------
    */


    /**
     * Add data
     * 
     * @return \Illuminate\Http\Response
     */
    public function addData(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [   
                'name'         => "required",
                'apprenants.*' => 'required',
                'lines.*'      => 'required',
                'published'    => 'required',
            ],
            [
                'required' => 'Le champ :attribute est requis',
            ]
        );

        $errors = $validator->errors();
        if (count($errors) != 0) {
            return response()->json([
                'success' => false,
                'message' => $errors->first()
            ]);
        }

        $name       =  $validator->validated()['name'];
        $published  =  $validator->validated()['published'];
        $apprenants =  $validator->validated()['apprenants'];
        $lines      =  $validator->validated()['lines'];

        foreach ($apprenants as $apprenant) {
            $sondage            = new EvalSondage();
            $sondage->name      = $name;
            $sondage->user_id   = $apprenant['id'];
            $sondage->accepted  = 1;
            $sondage->published = $published;
            $sondage->save();

            foreach ($lines as $lineInfo) {
                $sondageLine = new EvalSondageLines();
                $sondageLine->sondage_id = $sondage->id;
                $sondageLine->langage_id = $lineInfo['langage_id'] ?? null;
                $sondageLine->skill_id   = $lineInfo['skill_id'];
                $sondageLine->save();
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Sondage ajouté"
        ]);
    }


    /**
     * Proposing data
     * 
     * @return \Illuminate\Http\Response
     */
    public function proposingData(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [   
                'name'         => "required",
                'lines.*'      => 'required',
            ],
            [
                'required' => 'Le champ :attribute est requis',
            ]
        );

        $errors = $validator->errors();
        if (count($errors) != 0) {
            return response()->json([
                'success' => false,
                'message' => $errors->first()
            ]);
        }

        $name       =  $validator->validated()['name'];
        $lines      =  $validator->validated()['lines'];

        $sondage            = new EvalSondage();
        $sondage->name      = $name;
        $sondage->user_id   = Auth::id();
        $sondage->save();

        foreach ($lines as $lineInfo) {
            $sondageLine = new EvalSondageLines();
            $sondageLine->sondage_id = $sondage->id;
            $sondageLine->langage_id = $lineInfo['langage_id'] ?? null;
            $sondageLine->skill_id   = $lineInfo['skill_id'];
            $sondageLine->save();
        }
        
        return response()->json([
            'success' => true,
            'message' => "Sondage ajouté"
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Update data functions
    |--------------------------------------------------------------------------
    */


    /**
     * Update data
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateData(Request $request, $id) {
        
    }


    /**
     * Update data (Accept proposing)
     * 
     * @return \Illuminate\Http\Response
     */
    public function acceptProposing($id) {
        $sondage = EvalSondage::where(['id' => $id])->first(); 
        if(!$sondage){
            return response()->json([
                'success' => false,
                'message' => "Sondage introuvable"
            ], 400);
        }
    }

    
    /**
     * Update data (set it to draft mode)
     * 
     * @return \Illuminate\Http\Response
     */
    public function setToDraft($id) {
        $sondage = EvalSondage::where(['id' => $id])->first(); 
        if(!$sondage){
            return response()->json([
                'success' => false,
                'message' => "Sondage introuvable"
            ], 400);
        }
    }

    
    /**
     * Update data (set it to publish mode)
     * 
     * @return \Illuminate\Http\Response
     */
    public function setToPublish($id) {
        $sondage = EvalSondage::where(['id' => $id])->first(); 
        if(!$sondage){
            return response()->json([
                'success' => false,
                'message' => "Sondage introuvable"
            ], 400);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Delete data functions
    |--------------------------------------------------------------------------
    */

    /**
     * Delete data
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteData($id) {
        
    }
}
