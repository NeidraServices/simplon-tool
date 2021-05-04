<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Deliver_ProjetController;
use App\Http\Controllers\Deliver_CommentairesController;
use App\Http\Controllers\Deliver_CompetenceController;
use App\Http\Controllers\Deliver_MediaController;
use App\Http\Controllers\Deliver_TagController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/*
|--------------------------------------------------------------------------
| Authentication routes
|--------------------------------------------------------------------------
*/

Route::post('/connexion', [AuthController::class, 'connexion'])->name('api.connexion');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('api.logout');
Route::post('/email/verification', [AuthController::class, 'verifymail'])->name('api.verify.email');
Route::post('/verify', [AuthController::class, 'verifyToken'])->middleware(['auth:api'])->name('api.verify.token');



Route::prefix('deliver')->group(function () {

Route::resources("/projet",[Deliver_ProjetController::class]);
Route::resources("/commentaires",[Deliver_CommentairesController::class]);
Route::resources("/competences",[Deliver_CompetenceController::class]);
Route::resources("/medias",[Deliver_MediaController::class]);
Route::resources("/tags",[Deliver_TagController::class]);

});