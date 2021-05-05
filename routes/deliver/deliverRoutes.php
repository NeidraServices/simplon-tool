<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Deliver_ProjetController;
use App\Http\Controllers\Deliver_CommentairesController;
use App\Http\Controllers\Deliver_CompetenceController;
use App\Http\Controllers\Deliver_MediaController;
use App\Http\Controllers\Deliver_TagController;
use App\Http\Controllers\Deliver_AffectationController;
use App\Http\Resources\Deliver_ProjetResource;
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

    Route::get("/competences",[Deliver_CompetenceController::class,"liste"]);
    Route::post("/competences/ajout",[Deliver_CompetenceController::class,"addCompetence"]);
    Route::post("/competences/lier",[Deliver_CompetenceController::class,"relierProjet"]);
    Route::delete("/competences/delier",[Deliver_CompetenceController::class,"delierProjet"]);

    Route::post("/projet/affecter",[Deliver_AffectationController::class,"affecter"]);
    Route::delete("/projet/retierapprenant",[Deliver_AffectationController::class,"supprimerApprenant"]);

    Route::get("/tags",[Deliver_TagController::class,"liste"]);
    Route::post("/tags/ajout",[Deliver_TagController::class,"ajout"]);
    Route::post("/tags/lier",[Deliver_TagController::class,"relierProjet"]);
    Route::delete("/tags/delier",[Deliver_TagController::class,"delierProjet"]);

    Route::get("/commentaires",[Deliver_CommentairesController::class,"liste"]);
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

Route::get("/projets",[Deliver_ProjetController::class,"projets"])->name('api.projects.retrieveall');
Route::post("/projets/ajouter",[Deliver_ProjetController::class,"addProjet"])->name('api.projects.create');
Route::get("/projets/{id}/voir",[Deliver_ProjetController::class,"getProjet"])->name('api.projects.retrieveone');
Route::post("/projets/{id}/modifier",[Deliver_ProjetController::class,"editProjet"])->name('api.projects.edit');
Route::post("/projets/{id}/supprimer",[Deliver_ProjetController::class,"deleteProjet"])->name('api.projects.delete');


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
