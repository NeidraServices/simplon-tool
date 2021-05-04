<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvalLangageController;
use App\Http\Controllers\EvalPromotionController;
use App\Http\Controllers\EvalReferentielController;
use App\Http\Controllers\EvalSkillController;
use App\Http\Controllers\EvalSondageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Evaluation360 Promotions routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){
    Route::get("/promotion/list", [EvalPromotionController::class, "getData"])->name('api.promotion.retrieve');
    Route::post("/promotion/create", [EvalPromotionController::class, "addData"])->name('api.promotion.create');
    Route::put("/promotion/{id}/update", [EvalPromotionController::class, "updateData"])->name('api.promotion.update');
    Route::delete("/promotion/{id}/delete", [EvalPromotionController::class, "deleteData"])->name('api.promotion.delete');
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
| Evaluation360 Référentiel routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){
    Route::get("/referentiel/list", [EvalReferentielController::class, "getData"])->name('api.promotion.retrieve');
    Route::post("/referentiel/create", [EvalReferentielController::class, "addData"])->name('api.promotion.create');
    Route::put("/referentiel/{id}/update", [EvalReferentielController::class, "updateData"])->name('api.promotion.update');
    Route::delete("/referentiel/{id}/delete", [EvalReferentielController::class, "deleteData"])->name('api.promotion.delete');
});

/*
|--------------------------------------------------------------------------
| Evaluation360 Skill routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){
    Route::get("/skill/list", [EvalSkillController::class, "getData"])->name('api.skill.retrieve');
    Route::post("/skill/create", [EvalSkillController::class, "addData"])->name('api.skill.create');
    Route::put("/skill/{id}/update", [EvalSkillController::class, "updateData"])->name('api.skill.update');
    Route::delete("/skill/{id}/delete", [EvalSkillController::class, "deleteData"])->name('api.skill.delete');
});


/*
|--------------------------------------------------------------------------
| Evaluation360 Langages routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){
    Route::get("/langage/list", [EvalLangageController::class, "getData"])->name('api.langage.retrieve');
    Route::post("/langage/create", [EvalLangageController::class, "addData"])->name('api.langage.create');
    Route::put("/langage/{id}/update", [EvalLangageController::class, "updateData"])->name('api.langage.update');
    Route::delete("/langage/{id}/delete", [EvalLangageController::class, "deleteData"])->name('api.langage.delete');
});

/*
|--------------------------------------------------------------------------
| Evaluation360 Sondage / SondageLines routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){
    Route::prefix('/formateur')->group(function(){
        Route::get("/sondage/list", [EvalSondageController::class, "getDataAll"])->name('api.sondage.formateur.retrieve');
        Route::post("/sondage/create", [EvalSondageController::class, "addData"])->name('api.sondage.formateur.create');
        Route::put("/sondage/update", [EvalSondageController::class, "updateData"])->name('api.sondage.formateur.updateData');
        Route::put("/sondage/proposing/accepte", [EvalSondageController::class, "acceptProposing"])->name('api.sondage.formateur.acceptProposing');
        Route::put("/sondage/draft", [EvalSondageController::class, "setToDraft"])->name('api.sondage.formateur.setToDraft');
        Route::put("/sondage/publish", [EvalSondageController::class, "setToPublish"])->name('api.sondage.formateur.setToPublish');
        Route::delete("/sondage/delete", [EvalSondageController::class, "deleteData"])->name('api.sondage.formateur.deleteData');
    });
});

Route::middleware(['auth:api'])->group(function(){
    Route::prefix('/apprenant')->group(function(){
        Route::get("/sondage/list", [EvalSondageController::class, "getDataSpecific"])->name('api.sondage.apprenant.retrieve');
        Route::post("/sondage/proposing", [EvalSondageController::class, "proposingData"])->name('api.sondage.apprenant.proposing');
    });
});

