<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvalPromotion;
use App\Http\Resources\EvalPromotionResource;
use Illuminate\Support\Facades\Validator;

class EvalPromotionController extends Controller
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
        $promotions = EvalPromotion::all();
        return EvalPromotionResource::collection($promotions);
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
                'name'    => "required",
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

        $name =  $validator->validated()['name'];
        $promotion = new EvalPromotion();
        $promotion->name = $name;
        $promotion->save();

        return response()->json([
            'success' => true,
            'message' => "Promotion ajouté"
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
                'name'    => "required",
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

        $name =  $validator->validated()['name'];
        $promotion = EvalPromotion::where(['id' => $id])->first();

        if(!$promotion) {
            return response()->json([
                'success' => false,
                'message' => "Promotion introuvable"
            ], 400);
        }

        $promotion->name = $name;
        $promotion->save();

        return response()->json([
            'success' => true,
            'message' => "Promotion mis à jour"
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
        $promotion = EvalPromotion::where(['id' => $id])->first();

        if(!$promotion) {
            return response()->json([
                'success' => false,
                'message' => "Promotion introuvable"
            ], 400);
        }

        $promotion->delete();
        return response()->json([
            'success' => true,
            'message' => "Promotion supprimée"
        ]);
    }
}
