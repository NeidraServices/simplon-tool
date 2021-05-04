<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvalReferentiel;
use App\Http\Resources\EvalReferentielResource;
use Illuminate\Support\Facades\Validator;

class EvalReferentielController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Get data functions
    |--------------------------------------------------------------------------
    */


    /**
     * Retrieve all
     * 
     * @return \Illuminate\Http\Response
     */
    public function getData() {
        $referentiels = EvalReferentiel::all();
        return EvalReferentielResource::collection($referentiels);
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
                'description'  => "required",
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
            ], 400);
        }

        $description =  $validator->validated()['description'];
        $referentiel = new EvalReferentiel();
        $referentiel->description = $description;
        $referentiel->save();

        return response()->json([
            'success' => true,
            'message' => "Référentiel ajouté"
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
                'description'  => "required",
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
            ], 400);
        }

        $description =  $validator->validated()['description'];
        $referentiel = EvalReferentiel::where(['id' => $id])->first();

        if(!$referentiel) {
            return response()->json([
                'success' => false,
                'message' => "Référentiel introuvable"
            ], 400);
        }

        $referentiel->description = $description;
        $referentiel->save();

        return response()->json([
            'success' => true,
            'message' => "Référentiel mis à jour"
        ]);
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
        $referentiel = EvalReferentiel::where(['id' => $id])->first();

        if(!$referentiel) {
            return response()->json([
                'success' => false,
                'message' => "Référentiel introuvable"
            ], 400);
        }

        $referentiel->delete();
        return response()->json([
            'success' => true,
            'message' => "Référentiel supprimée"
        ]);
    }
}
