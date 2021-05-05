<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Mail\NotificationCreateAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EvalCoorteController extends Controller
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
    public function getData()
    {
        $coorte = User::where(['role_id' => 3])->get();
        return UserResource::collection($coorte);
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
    public function addData(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [   
                'name'    => "required",
                'surname' => "required",
                'email'   => "required|unique:users|regex:/^.+@.+$/i",
            ],
            [
                'required' => 'Le champ :attribute est requis',
                'unique'   => "Adresse email existe déjà",
                'regex'    => "Ce n'est pas une adresse email"
            ]
        );

        $errors = $validator->errors();
        if (count($errors) != 0) {
            return response()->json([
                'success' => false,
                'message' => $errors->first()
            ], 400);
        }

        $name    =  $validator->validated()['name'];
        $surname =  $validator->validated()['surname'];
        $email   =  $validator->validated()['email'];

        $confirmToken      = Str::random(20);
        $generatePassword  = Str::random(10);

        $user               = new User();
        $user->name         = strtoupper($name);
        $user->surname      = ucfirst($surname);
        $user->email        = $email;
        $user->password     = Hash::make($generatePassword);
        $user->confirmToken = $confirmToken;
        $user->role_id      = 3;
        $user->save();

        $url = request()->getSchemeAndHttpHost() . "/email/verification/" . $confirmToken;
        Mail::to($user->email)->send(new NotificationCreateAccount($user->name, $user->surname, $generatePassword , $url));

        return response()->json([
            "success" => true,
            "message" => "Le compte utilisateur a été créé"
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
    public function updateData(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [   
                'name'    => "required",
                'surname' => "required",
                'email'   => "required|regex:/^.+@.+$/i",
            ],
            [
                'required' => 'Le champ :attribute est requis',
                'regex'    => "Ce n'est pas une adresse email"
            ]
        );

        $errors = $validator->errors();
        if (count($errors) != 0) {
            return response()->json([
                'success' => false,
                'message' => $errors->first()
            ], 400);
        }

        $name    =  $validator->validated()['name'];
        $surname =  $validator->validated()['surname'];
        $email   =  $validator->validated()['email'];

        $confirmToken      = Str::random(20);
        $generatePassword  = Str::random(10);

        $user               = User::where(['id' => $id])->first();
        $user->name         = strtoupper($name);
        $user->surname      = ucfirst($surname);
        $user->email        = $email;
        $user->password     = Hash::make($generatePassword);
        $user->confirmToken = $confirmToken;
        $user->role_id      = 3;
        $user->save();

        $url = request()->getSchemeAndHttpHost() . "/email/verification/" . $confirmToken;
        Mail::to($user->email)->send(new NotificationCreateAccount($user->name, $user->surname, $generatePassword , $url));

        return response()->json([
            "success" => true,
            "message" => "Le compte utilisateur a été modifié"
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
    public function deleteData($id)
    {
        $user               = User::where(['id' => $id])->first();
        if(!$user) {
            return response()->json([
                'success' => false,
                'message' => "Compte apprenant introuvable"
            ], 400);
        }

        $user->delete();
        return response()->json([
            'success' => true,
            'message' => "Compte apprenant supprimé"
        ]);
    }


    /**
     * Delete data (array selected)
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteDataArray(Request $request)
    {

    }
}
