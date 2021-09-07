<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
  public function forgot()
  {
    $credentials = request()->validate(['email' => 'required|email']);

    Password::sendResetLink($credentials);

    return response()->json(["message" => 'Lien de réinitialisation du mot de passe envoyé sur votre identifiant de messagerie.']);
  }

  public function reset()
  {
    $credentials = request()->validate([
      'email' => 'required|email',
      'token' => 'required|string',
      'password' => 'required',
      'confirm_password' => 'required'
    ]);

    $reset_password_status = Password::reset($credentials, function ($user, $password) {
      $user->password = Hash::make($password);
      $user->save();
    });

    if ($reset_password_status == Password::INVALID_TOKEN) {
      return response()->json(["message" => "Le token est invalide dans ces conditions"], 400);
    }

    return response()->json(["message" => "Le mot de passe à été changé avec succès !"]);
  }
}
