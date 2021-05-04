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


/*
|--------------------------------------------------------------------------
| Evaluation360 Référentiel routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});


/*
|--------------------------------------------------------------------------
| Evaluation360 Promotions routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});

/*
|--------------------------------------------------------------------------
| Evaluation360 Coorte routes (formateur)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});

/*
|--------------------------------------------------------------------------
| Evaluation360 Langages routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});

/*
|--------------------------------------------------------------------------
| Evaluation360 Skill routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});


/*
|--------------------------------------------------------------------------
| Evaluation360 user routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});

/*
|--------------------------------------------------------------------------
| Evaluation360 Sondage routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});


/*
|--------------------------------------------------------------------------
| Deliver commentaires routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->prefix("/deliver")->group(function(){
    Route::apiResource("/commentaires",[Deliver_CommentairesController::class]);
});


/*
|--------------------------------------------------------------------------
| Deliver compétences routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->prefix("/deliver")->group(function(){
    Route::apiResource("/competences",[Deliver_CompetenceController::class]);
});

/*
|--------------------------------------------------------------------------
| Deliver media routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->prefix("/deliver")->group(function(){
    Route::apiResource("/medias",[Deliver_MediaController::class]);
});


/*
|--------------------------------------------------------------------------
| Deliver projet routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){
    Route::apiResource("/projet",[Deliver_ProjetController::class]);
});

/*
|--------------------------------------------------------------------------
| Deliver tag routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->prefix("/deliver")->group(function(){
    Route::apiResource("/tags",[Deliver_TagController::class]);
});


/*
|--------------------------------------------------------------------------
| Deliver users routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});


/*
|--------------------------------------------------------------------------
| Markdown archive routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});


/*
|--------------------------------------------------------------------------
| Markdown Category routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});

/*
|--------------------------------------------------------------------------
| Markdown Commentary routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});


/*
|--------------------------------------------------------------------------
| Markdown Contribution routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});

/*
|--------------------------------------------------------------------------
| Markdown markdown routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});

/*
|--------------------------------------------------------------------------
| Markdown user routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});