<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\Deliver_ProjetResource;
use App\Http\Controllers\Deliver_TagController;
use App\Http\Controllers\Deliver_MediaController;
use App\Http\Controllers\Deliver_RenduController;
use App\Http\Controllers\Deliver_ProjetController;
use App\Http\Controllers\Deliver_CompetenceController;
use App\Http\Controllers\Deliver_AffectationController;
use App\Http\Controllers\Deliver_CommentairesController;
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
    Route::post("/competences/update",[Deliver_CompetenceController::class,"update"]);
    Route::post("/competences/delete",[Deliver_CompetenceController::class,"delete"]);
    Route::post("/competences/lier",[Deliver_CompetenceController::class,"relierProjet"]);
    Route::delete("/competences/delier",[Deliver_CompetenceController::class,"delierProjet"]);

    Route::post("/projet/affecter",[Deliver_AffectationController::class,"affecter"]);
    Route::delete("/projet/retierapprenant",[Deliver_AffectationController::class,"supprimerApprenant"]);

    Route::get("/tags",[Deliver_TagController::class,"liste"]);
    Route::post("/tags/update",[Deliver_TagController::class,"update"]);
    Route::post("/tags/delete",[Deliver_TagController::class,"delete"]);
    Route::post("/tags/ajout",[Deliver_TagController::class,"ajout"]);
    Route::post("/tags/lier",[Deliver_TagController::class,"relierProjet"]);
    Route::delete("/tags/delier",[Deliver_TagController::class,"delierProjet"]);

    Route::get("/commentaires/{id}",[Deliver_CommentairesController::class,"liste"]);
    Route::post("/commentaires/ajouter",[Deliver_CommentairesController::class,"ajout"]);
    Route::post("/commentaires/repondre",[Deliver_CommentairesController::class,"repondre"]);
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
    Route::get("/projets/mesprojets/{formateur_id}",[Deliver_ProjetController::class,"mesProjets"])->name('api.projects.retrievemine');
});

Route::get("/projets",[Deliver_ProjetController::class,"projets"])->name('api.projects.retrieveall');
Route::post("/projets/ajouter",[Deliver_ProjetController::class,"addProjet"])->name('api.projects.create');
Route::get("/projets/{id}/voir",[Deliver_ProjetController::class,"getProjet"])->name('api.projects.retrieveone');
Route::post("/projets/{id}/modifier",[Deliver_ProjetController::class,"editProjet"])->name('api.projects.edit');
Route::post("/projets/{id}/supprimer",[Deliver_ProjetController::class,"deleteProjet"])->name('api.projects.delete');

Route::post("/create/rendus/projects/{projet_id}",[Deliver_RenduController::class,"addRendu"])->name('api.rendu.create');
Route::post("/edit/rendus/{rendu_id}",[Deliver_RenduController::class,"editRendu"])->name('api.rendu.edit');
Route::get("/view/rendus/projects/{projet_id}",[Deliver_RenduController::class,"rendus"])->name('api.rendu.retrieveall');
Route::get("/view/rendus/{rendu_id}",[Deliver_RenduController::class,"getRendu"])->name('api.rendu.retrieveone');
Route::delete("/delete/rendus/{rendu_id}",[Deliver_RenduController::class,"deleteRendu"])->name('api.rendu.delete');

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
