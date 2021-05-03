<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Handle user connection.
     *
     * @return \Illuminate\Http\Response
     */
    public function connection(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email'  => 'required',
                'password' => 'required',
            ],
            [
                'required' => 'Le champ :attribute est requis',
            ]
        );

        $errors = $validator->errors();
        if (count($errors) != 0) {
            return $errors->first();
        }

        $email   = $validator->validated()['email'];
        $password      = $validator->validated()['password'];
        $userExist     = User::where(["identifiant" => $email])->first();

        if (!$userExist || !Hash::check($password, $userExist->password)) {
            return "Identifiant ou mot de passe incorrecte";
        }

        $token = $userExist->createToken('AuthToken')->accessToken;
        return $token;
    }

}
