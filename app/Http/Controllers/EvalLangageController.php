<?php

namespace App\Http\Controllers;

use App\Models\EvalLangage;
use Illuminate\Http\Request;
use App\Http\Resources\EvalLangageResource;
use Illuminate\Support\Facades\Validator;

class EvalLangageController extends Controller
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
        $langages = EvalLangage::all();
        return EvalLangageResource::collection($langages);
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
                'image'   => "required|image|mimes:jpg,jpeg,png|max:2000",
            ],
            [
                'required' => 'Le champ :attribute est requis',
                'image'    => 'Image non fournis',
                'mimes'    => 'Extension invalide',
                'max'      => '2Mb maximum'
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
        $langage = new EvalLangage();
        $langage->name = $name;

        if($request->hasFile('image')) {
            $imageUploaded  = $validator->validated()['image'];
            $extension      = $imageUploaded->getClientOriginalExtension();
            $image          = time().rand().'.'.$extension;
            $imageUploaded->move(public_path('images/langages'), $image);
            $langage->image =   $image ;
        }

        $langage->save();
        return response()->json([
            'success' => true,
            'message' => "Langage ajouté"
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
                'image'   => "required|image|mimes:jpg,jpeg,png|max:2000",
            ],
            [
                'required' => 'Le champ :attribute est requis',
                'image'    => 'Image non fournis',
                'mimes'    => 'Extension invalide',
                'max'      => '2Mb maximum'
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
        $langage = EvalLangage::where(['id' => $id])->first();

        if(!$langage) {
            return response()->json([
                'success' => false,
                'message' => "Langage introuvable"
            ], 400);
        }

        $langage->name = $name;

        if($request->hasFile('image')) {
            $oldImage = $langage->image;
            $oldFilePath = public_path('images') . '/' . $oldImage;
            unlink($oldFilePath);

            $imageUploaded  = $validator->validated()['image'];
            $extension      = $imageUploaded->getClientOriginalExtension();
            $image          = time().rand().'.'.$extension;
            $imageUploaded->move(public_path('images/langages'), $image);
            $langage->image =   $image ;
        }

        $langage->save();
        return response()->json([
            'success' => true,
            'message' => "Langage mis à jour"
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
        $langage = EvalLangage::where(['id' => $id])->first();

        if(!$langage) {
            return response()->json([
                'success' => false,
                'message' => "Langage introuvable"
            ], 400);
        }

        $langage->delete();
        return response()->json([
            'success' => true,
            'message' => "Langage supprimé"
        ]);
    }
}
