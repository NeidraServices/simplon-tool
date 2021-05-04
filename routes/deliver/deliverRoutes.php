<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Deliver_ProjetController;
use App\Http\Controllers\Deliver_CommentairesController;
use App\Http\Controllers\Deliver_CompetenceController;
use App\Http\Controllers\Deliver_MediaController;
use App\Http\Controllers\Deliver_TagController;
use App\Http\Controllers\Deliver_AffectationController;
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

    Route::post("/projet/affecter",[Deliver_AffectationController::class,"affecter"]);
    Route::delete("/projet/retierapprenant",[Deliver_AffectationController::class,"supprimerApprenant"]);
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
    Route::post("/projets",[Deliver_ProjetResource::class,"projets"])->name('api.projects.retrieveall');
    Route::post("/projets/ajouter",[Deliver_ProjetResource::class,"addProjet"])->name('api.projects.create');
    Route::post("/projets/{id}/voir",[Deliver_ProjetResource::class,"getProjet"])->name('api.projects.retrieveone');
    Route::post("/projets/{id}/modifier",[Deliver_ProjetResource::class,"editProjet"])->name('api.projects.edit');
    Route::post("/projets/{id}/supprimer",[Deliver_ProjetResource::class,"deleteProjet"])->name('api.projects.delete');
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
