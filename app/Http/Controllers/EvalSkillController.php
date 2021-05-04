<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvalSkill;
use App\Http\Resources\EvalSkillResource;
use Illuminate\Support\Facades\Validator;

class EvalSkillController extends Controller
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
        $skills = EvalSkill::all();
        return EvalSkillResource::collection($skills);
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
                'description'      => "required",
                'referentiel_id'   => "required",
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

        $description    =  $validator->validated()['description'];
        $referentiel_id =  $validator->validated()['referentiel_id'];

        $skill = new EvalSkill();
        $skill->description    = $description;
        $skill->referentiel_id = $referentiel_id;
        $skill->save();

        return response()->json([
            'success' => true,
            'message' => "Compétence ajoutée"
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
                'description'      => "required",
                'referentiel_id'   => "required",
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

        $description    =  $validator->validated()['description'];
        $referentiel_id =  $validator->validated()['referentiel_id'];
        $skill = EvalSkill::where(['id' => $id])->first();

        if(!$skill) {
            return response()->json([
                'success' => false,
                'message' => "Compétence introuvable"
            ], 400);
        }

        $skill->description    = $description;
        $skill->referentiel_id = $referentiel_id;
        $skill->save();

        return response()->json([
            'success' => true,
            'message' => "Compétence mis à jour"
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
        $skill = EvalSkill::where(['id' => $id])->first();

        if(!$skill) {
            return response()->json([
                'success' => false,
                'message' => "Compétence introuvable"
            ], 400);
        }

        $skill->delete();
        return response()->json([
            'success' => true,
            'message' => "Compétence supprimée"
        ]);
    }
}
