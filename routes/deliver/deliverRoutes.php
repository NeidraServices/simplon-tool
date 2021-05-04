<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Deliver_ProjetController;
use App\Http\Controllers\Deliver_CommentairesController;
use App\Http\Controllers\Deliver_CompetenceController;
use App\Http\Controllers\Deliver_MediaController;
use App\Http\Controllers\Deliver_TagController;
/*
|--------------------------------------------------------------------------
| Deliver commentaires routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});


/*
|--------------------------------------------------------------------------
| Deliver compétences routes
|--------------------------------------------------------------------------
*/


    Route::post("/competences/ajout",[Deliver_CompetenceController::class,"addCompetence"]);
    Route::post("/competences/lier",[Deliver_CompetenceController::class,"relierProjet"]);
    Route::delete("/competences/delier",[Deliver_CompetenceController::class,"delierProjet"]);


/*
|--------------------------------------------------------------------------
| Deliver media routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});


/*
|--------------------------------------------------------------------------
| Deliver projet routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});

/*
|--------------------------------------------------------------------------
| Deliver tag routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});


/*
|--------------------------------------------------------------------------
| Deliver users routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});
