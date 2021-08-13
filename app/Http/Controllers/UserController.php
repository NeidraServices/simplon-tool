<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Fonction get qui recupère un utilisateur
     * @return user
     */

    public function getUser($id)
    {
        $user = User::where('id', $id)->first();
        return new UserResource($user);
    }

    /**
     * Fonction post qui permet de modifier un utilisateur
     * @return userUpdate
     */

    public function updateUser(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => '',
                'surname' => '',
                'email' => '',
            ],
        )->validate();

        $user = User::where('id', Auth::id())->first();
        $validator['name'] != null ? $user->name = $validator['name'] : null;
        $validator['surname'] != null ? $user->surname = $validator['surname'] : null;
        $validator['email'] != null ? $user->email = $validator['email'] : null;
        $user->save();
        return new UserResource($user);
    }

    /**
     * Fonction post qui permet de modifier le mot de passe de l'utilisateur
     * @return success
     */

    public function updatePassword(Request $request)
    {        
        $validator = Validator::make(
            $request->all(),
            [
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6'
            ],
            [
                'required' => 'Le champs :attribute est requis', // :attribute renvoie le champs / l'id de l'element en erreure
                'confirmed' => 'le :attriute doit être confirmer'
            ]
        )->validate();

        $user = User::where('id', Auth::id())->first();
        $user->password = Hash::make($validator['password']);
        $user->save();
        return response('Mot de passe changer avec succès', 200);;
    }

    /**
     * Fonction post qui permet de modifier l'avatar de l'utilisateur
     * @return success
     */

    public function updateAvatar(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'image' => 'required|image',
            ],
            [
                'required' => 'Le champs :attribute est requis', // :attribute renvoie le champs / l'id de l'element en erreure
            ]
        )->validate();

        $user = User::where('id', Auth::id())->first();
        $image = "";
        if ($request->hasFile('image')) {
            if ($request->hasFile('image')) {
                $oldImage = $user->avatar;

                if ($oldImage != null && $oldImage != "avatars/default.png") {
                    $oldFilePath = public_path('images') . '/' . $oldImage;
                    unlink($oldFilePath);
                    $imageUploaded  = $validator['image'];
                    $extension      = $imageUploaded->getClientOriginalExtension();
                    $image          = time() . rand() . '.' . $extension;
                    $imageUploaded->move(public_path('images/avatars'), $image);
                    $user->avatar = $image;
                } else {
                    $imageUploaded  = $validator['image'];
                    $extension      = $imageUploaded->getClientOriginalExtension();
                    $image          = time() . rand() . '.' . $extension;
                    $imageUploaded->move(public_path('images/avatars'), $image);
                    $user->avatar = $image;
                }
            }
        }
        $user->save();
        $respData = array('message' => 'Avatar changé avec succès', 'avatar_name' => $image);
        return response($respData, 200);
    }
}
