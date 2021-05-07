<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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
                'id' => 'required',
                'name' => '',
                'surname' => '',
                'email' => '',
            ],
        )->validate();

        $user = User::where('id', $validator['id'])->first();
        $validator['name'] != null ? $user->name = $validator['name'] : null;
        $validator['surname'] != null ? $user->surname = $validator['surname'] : null;
        $validator['email'] != null ? $user->email = $validator['email'] : null;
        $user->save();
        return new UserResource($user);
    }
}
