<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Mail\NotificationCreateAccount;
use App\Models\EvalSondage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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
        $userAuth = User::whereId(Auth::id())->first();
        $coorte = "";

        if ($userAuth->role_id == 3) {
            $coorte = User::where(['role_id' => 3, "promotion_id" => $userAuth->promotion_id])->get();
        } else {
            $coorte = User::where(['role_id' => 3])->get();
        }

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
                'name'      => "required",
                'surname'   => "required",
                'promotion' => "required",
                'email'     => "required|unique:users|regex:/^.+@.+$/i",
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

        $name        =  $validator->validated()['name'];
        $surname     =  $validator->validated()['surname'];
        $email       =  $validator->validated()['email'];
        $promotion   =  $validator->validated()['promotion'];

        $confirmToken      = Str::random(20);
        $generatePassword  = Str::random(10);

        $user               = new User();
        $user->name         = strtoupper($name);
        $user->surname      = ucfirst($surname);
        $user->email        = $email;
        $user->password     = Hash::make($generatePassword);
        $user->confirmToken = $confirmToken;
        $user->promotion_id = $promotion;
        $user->role_id      = 3;
        $user->save();

        $url = request()->getSchemeAndHttpHost() . "/email/verification/" . $confirmToken;
        Mail::to($user->email)->send(new NotificationCreateAccount($user->name, $user->surname, $generatePassword, $url));

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
                'name'      => "required",
                'surname'   => "required",
                'promotion' => "required",
                'email'     => "required|regex:/^.+@.+$/i",
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

        $name        =  $validator->validated()['name'];
        $surname     =  $validator->validated()['surname'];
        $email       =  $validator->validated()['email'];
        $promotion   =  $validator->validated()['promotion'];


        $confirmToken      = Str::random(20);
        $generatePassword  = Str::random(10);

        $user               = User::where(['id' => $id])->first();
        $user->name         = strtoupper($name);
        $user->surname      = ucfirst($surname);
        $user->email        = $email;
        $user->password     = Hash::make($generatePassword);
        $user->confirmToken = $confirmToken;
        $user->promotion_id = $promotion;
        $user->role_id      = 3;
        $user->save();

        $url = request()->getSchemeAndHttpHost() . "/email/verification/" . $confirmToken;
        Mail::to($user->email)->send(new NotificationCreateAccount($user->name, $user->surname, $generatePassword, $url));

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
        if (!$user) {
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



    public function filterApprenant(Request $request)
    {
        $userAuth = User::whereId(Auth::id())->first();
        $users = User::query();
        if ($request->apprenant) {
            if ($userAuth->role_id == 3) {
                $users =  $users->where('name', 'like', '%' . $request->apprenant . '%')->where("promotion_id", $userAuth->promotion_id);
            } else {
                $users =  $users->where('name', 'like', '%' . $request->apprenant . '%');
            }
        }

        $users = $users->get();
        if ($request->note) {
            $users_noted = [];

            switch ($request->note) {
                case 'bas':

                    foreach ($users as $user) {
                        $sondages_notes = [];
                        $sondages = EvalSondage::where('user_id', $user->id)->get();
                        foreach ($sondages as $sondage) {
                            $sondages_notes[] = $sondage->global_note;
                        }
                        if (!empty($sondages_notes)) {
                            $note_global = array_sum($sondages_notes) / count($sondages_notes);
                            $note_global = round($note_global);
                            $user['note'] = $note_global;
                            if ($note_global <= 9) {
                                $users_noted[] = $user;
                            }
                        }
                    }

                    return UserResource::collection($users_noted);
                    break;
                case 'moyen':

                    foreach ($users as $user) {
                        $sondages_notes = [];
                        $sondages = EvalSondage::where('user_id', $user->id)->get();
                        foreach ($sondages as $sondage) {
                            $sondages_notes[] = $sondage->global_note;
                        }
                        if (!empty($sondages_notes)) {
                            $note_global = array_sum($sondages_notes) / count($sondages_notes);
                            $note_global = round($note_global);
                            $user['note'] = $note_global;
                            if ($note_global > 9 && $note_global <= 14) {
                                $users_noted[] = $user;
                            }
                        }
                    }
                    return UserResource::collection($users_noted);

                    break;
                case 'haute':
                    foreach ($users as $user) {
                        $sondages_notes = [];
                        $sondages = EvalSondage::where('user_id', $user->id)->get();
                        foreach ($sondages as $sondage) {
                            $sondages_notes[] = $sondage->global_note;
                        }
                        if (!empty($sondages_notes)) {
                            $note_global = array_sum($sondages_notes) / count($sondages_notes);
                            $note_global = round($note_global);
                            $user['note'] = $note_global;
                            if ($note_global > 14) {
                                $users_noted[] = $user;
                            }
                        }
                    }
                    return UserResource::collection($users_noted);
                    break;
            }
        }
        return UserResource::collection($users);
    }
}
