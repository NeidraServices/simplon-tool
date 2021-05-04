<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvalSondageLines;
use App\Http\Resources\EvalSondageLinesResource;
use Illuminate\Support\Facades\Validator;

class EvalSondageLinesController extends Controller
{
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
                'sondage_id' => 'required',
                'langage_id' => 'required',
                'skill_id'   => 'required',
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

        $sondage_id     =  $validator->validated()['sondage_id'];
        $langage_id     =  $validator->validated()['langage_id'];
        $skill_id       =  $validator->validated()['skill_id'];

        $sondageLine = new EvalSondageLines();
        $sondageLine->sondage_id = $sondage_id;
        $sondageLine->langage_id = $langage_id;
        $sondageLine->skill_id   = $skill_id;
        $sondageLine->save();

        return response()->json([
            'success' => true,
            'message' => "Une ligne a été ajouté"
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
        $validator = Validator::make(
            $request->all(),
            [   
                'sondage_id' => 'required',
                'langage_id' => 'required',
                'skill_id'   => 'required',
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

        $sondage_id     =  $validator->validated()['sondage_id'];
        $langage_id     =  $validator->validated()['langage_id'];
        $skill_id       =  $validator->validated()['skill_id'];

        $sondageLine = EvalSondageLines::where(['id' => $id])->first();
        if(!$sondageLine){
            return response()->json([
                'success' => false,
                'message' => "Sondage introuvable"
            ], 400);
        }

        $sondageLine->sondage_id = $sondage_id;
        $sondageLine->langage_id = $langage_id;
        $sondageLine->skill_id   = $skill_id;
        $sondageLine->save();

        return response()->json([
            'success' => true,
            'message' => "Une ligne a été mis à jour"
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Delete data functions
    |--------------------------------------------------------------------------
    */


    /**
     * Delete data (one by one)
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteData($id) {
        $sondageLine = EvalSondageLines::where(['id' => $id])->first();
        if(!$sondageLine){
            return response()->json([
                'success' => false,
                'message' => "Sondage introuvable"
            ], 400);
        }

        $sondageLine->delete();
        return response()->json([
            'success' => true,
            'message' => "Une ligne a été supprimer"
        ]);
    }


    /**
     * Delete data (array selected)
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteDataArray(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [   
                'sondageLine.*' => 'required',
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

        $sondageLine     =  $validator->validated()['sondageLine'];
        foreach ($sondageLine as $line) {
            $sondageLineDetail = EvalSondageLines::where(['id' => $line['id']])->first();
            if($sondageLineDetail){
                $sondageLineDetail->delete();
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Toutes les lignes ont été supprimer"
        ]);
    }
}
