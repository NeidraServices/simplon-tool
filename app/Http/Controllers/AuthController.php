<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use App\Jobs\ResetTentatives;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationLockedAccount;
use App\Mail\NotificationUnlockedAccount;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    /**
     * handle login request
     * @return \Illuminate\Http\Response
     */
    public function connexion(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'email'     => 'required',
                'password'  => 'required',
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

        $email      = $validator->validated()['email'];
        $password   = $validator->validated()['password'];
        $userExist  = User::where(["email" => $email])->first();

        if (!$userExist) {
            return response()->json([
                'success' => false,
                'message' => 'Adresse mail et/ou mot de passe incorrect(s)',
            ], 404);
        }

        if($userExist->verified_at == null){
            return response()->json([
                'success' => false,
                'message' => 'Vous devez confirmer votre adresse email',
            ], 404);
        }

        $oldTentative = $userExist->tentatives;

        switch ($oldTentative) {
            case 3:
                $userExist->tentatives = 4;
                $userExist->save();
                Mail::to($userExist->email)->later(now()->addMinutes(30), new NotificationUnlockedAccount());
                $resetJob = (new ResetTentatives($userExist->id, $userExist->email))->delay(Carbon::now()->addMinutes(30));
                dispatch($resetJob);

                $ip  = $_SERVER['REMOTE_ADDR'];
                openlog('CVTHEQUE_AUTH - login', LOG_NDELAY, LOG_USER);
                syslog(LOG_INFO, "L'utilisateur {$userExist->email} à atteint son nombre maximal de tentative de connexion depuis l'adresse IP {$ip} ! ");
                Mail::to($userExist->email)->send(new NotificationLockedAccount());

                return response()->json([
                    'success' => false,
                    'message' => "Veuillez réessayer dans 30 minutes",
                ]);
                break;
            
            case 4:
                return response()->json([
                    'success' => false,
                    'message' => "Veuillez réessayer dans quelques minutes",
                ]);
                break;
            default:
                if (Hash::check($password, $userExist->password)) {
                    $userExist->tentatives = 0;
                    $userExist->save();
                    $token = $userExist->createToken('AuthToken')->accessToken;
                    return response()->json([
                        "success"      => true,
                        "message"      => "Vous êtes connecté !",
                        "token"        => $token,
                        "informations" => new UserResource($userExist)
                    ]);
                } else {
                    $tentative    = $userExist->tentatives + 1;
                    $userExist->tentatives = $tentative;
                    $userExist->save();
                    return response()->json([
                        'success' => false,
                        'message' => "Adresse email ou mot de passe incorrecte",
                    ], 404);
                }
                break;
        }
    }

    
    /**
     * Verify mail
     *
     *  @return \Illuminate\Http\Response
     */
    public function verifymail(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'confirmToken' => 'required',
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

        $confirmToken  = $validator->validated()['confirmToken'];
        $userExist = User::where(['confirmToken' => $confirmToken])->first();

        if (!$userExist) {
            return response()->json([
                "success" => false,
                "message" => "Jeton de vérification invalide"
            ]);
        }

        if ($userExist->verified_at != null) {
            return response()->json([
                "success" => false,
                "message" => "Adresse e-mail déjà vérifier"
            ]);
        }

        $userExist->verified_at  =  now();
        $userExist->confirmToken = null;
        $userExist->save();

        return response()->json([
            "success" => true,
            "message" => "Adresse email vérifier avec succès"
        ]);
    }
    
    
    /**
     * Handle disconnect request.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json([
            'success' => true,
            "message" => "Vous êtes déconnecté !",
        ]);
    }


    /**
     * Check token validity
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyToken()
    {
        $loggedUser   = Auth::user();
        if($loggedUser) {
            return response()->json(['isTokenValid' => true]);
        } else {
            return response()->json(['isTokenValid' => false]);
        }
    }
}
