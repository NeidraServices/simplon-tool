<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvalSondage;
use App\Http\Resources\EvalSondageResource;
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
        return EvalSondageResource::collection($sondages);
    }


    /**
     * Retrieve all (connected learners)
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDataSpecific() {
        $sondages = EvalSondage::where(['user_id' => Auth::id()])->get();
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
        $apprenants =  $validator->validated()['apprenants'];


    }


    /**
     * Proposing data
     * 
     * @return \Illuminate\Http\Response
     */
    public function proposingData(Request $request) {
        
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
        
    }

    
    /**
     * Update data (set it to draft mode)
     * 
     * @return \Illuminate\Http\Response
     */
    public function setToDraft($id) {
        
    }

    
    /**
     * Update data (set it to publish mode)
     * 
     * @return \Illuminate\Http\Response
     */
    public function setToPublish($id) {
        
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
