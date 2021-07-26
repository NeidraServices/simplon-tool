<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvalCoorteController;
use App\Http\Controllers\EvalLangageController;
use App\Http\Controllers\EvalPromotionController;
use App\Http\Controllers\EvalReferentielController;
use App\Http\Controllers\EvalSkillController;
use App\Http\Controllers\EvalSondageController;
use App\Http\Controllers\EvalSondageLinesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Evaluation360 Apprenants routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function () {
    Route::get('/apprenants', [EvalCoorteController::class, 'getData'])->name('api.coort.retrieve');
    Route::post('/apprenants/create', [EvalCoorteController::class, 'addData'])->name('api.coort.addData');
    Route::put('/apprenants/{id}/update', [EvalCoorteController::class, 'updateData'])->name('api.coort.updateData');
    Route::delete('/apprenants/{id}/delete', [EvalCoorteController::class, 'deleteData'])->name('api.coort.delete');
});

Route::middleware(['auth:api'])->prefix('user')->group(function () {
    Route::get('/{id}', [UserController::class, 'getUser'])->where('id', "[0-9]+");
    Route::post('/update', [UserController::class, 'updateUser']);
    Route::post('/update/password', [UserController::class, 'updatePassword']);
    Route::post('/image/update', [UserController::class, 'updateAvatar']);
  });
  
/*
|--------------------------------------------------------------------------
| Evaluation360 Promotions routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->prefix("promotion")->group(function () {
    Route::get("/list", [EvalPromotionController::class, "getData"])->name('api.promotion.retrieve');
    Route::post("/create", [EvalPromotionController::class, "addData"])->name('api.promotion.create');
    Route::put("/{id}/update", [EvalPromotionController::class, "updateData"])->name('api.promotion.update');
    Route::delete("/{id}/delete", [EvalPromotionController::class, "deleteData"])->name('api.promotion.delete');
});


/*
|--------------------------------------------------------------------------
| Evaluation360 Référentiel routes
|--------------------------------------------------------------------------
*/
 

Route::middleware(['auth:api'])->prefix("/referentiel")->group(function () {
    Route::get("/list", [EvalReferentielController::class, "getData"])->name('api.referentiel.retrieve');
    Route::post("/create", [EvalReferentielController::class, "addData"])->name('api.referentiel.create');
    Route::put("/{id}/update", [EvalReferentielController::class, "updateData"])->name('api.referentiel.update');
    Route::delete("/{id}/delete", [EvalReferentielController::class, "deleteData"])->name('api.referentiel.delete');
});

/*
|--------------------------------------------------------------------------
| Evaluation360 Skill routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->prefix("/skill")->group(function () {
    Route::get("/list", [EvalSkillController::class, "getData"])->name('api.skill.retrieve');
    Route::post("/create", [EvalSkillController::class, "addData"])->name('api.skill.create');
    Route::put("/{id}/update", [EvalSkillController::class, "updateData"])->name('api.skill.update');
    Route::delete("/{id}/delete", [EvalSkillController::class, "deleteData"])->name('api.skill.delete');
});


/*
|--------------------------------------------------------------------------
| Evaluation360 Langages routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->prefix("/langage")->group(function(){
    Route::get("/list", [EvalLangageController::class, "getData"])->name('api.langage.retrieve');
    Route::post("/create", [EvalLangageController::class, "addData"])->name('api.langage.create');
    Route::put("/{id}/update", [EvalLangageController::class, "updateData"])->name('api.langage.update');
    Route::delete("/{id}/delete", [EvalLangageController::class, "deleteData"])->name('api.langage.delete');
});

/*
|--------------------------------------------------------------------------
| Evaluation360 Sondage / SondageLines routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->prefix("/sondageLine")->group(function () {
    Route::post("/create", [EvalSondageLinesController::class, "addData"])->name('api.sondageLine.create');
    Route::put("/{id}/update", [EvalSondageLinesController::class, "updateData"])->name('api.sondageLine.updateData');
    Route::delete("/{id}/delete", [EvalSondageLinesController::class, "deleteData"])->name('api.sondageLine.deleteData');
    Route::post("/delete/all", [EvalSondageLinesController::class, "deleteDataArray"])->name('api.sondageLine.deleteDataArray');
});

Route::middleware(['auth:api'])->group(function(){
    Route::prefix("/formateur/sondage")->group(function() {
        Route::get("/list", [EvalSondageController::class, "getDataAll"])->name('api.sondage.formateur.retrieve');
    });

    Route::prefix('/sondage')->group(function () {
        Route::post("/create", [EvalSondageController::class, "addData"])->name('api.sondage.formateur.create');
        Route::put("/update", [EvalSondageController::class, "updateData"])->name('api.sondage.formateur.updateData');
        Route::put("{id}/proposing/accepte", [EvalSondageController::class, "acceptProposing"])->name('api.sondage.formateur.acceptProposing');
        Route::put("/draft", [EvalSondageController::class, "setToDraft"])->name('api.sondage.formateur.setToDraft');
        Route::put("/publish", [EvalSondageController::class, "setToPublish"])->name('api.sondage.formateur.setToPublish');
        Route::delete("/{name}/delete", [EvalSondageController::class, "deleteData"])->name('api.sondage.formateur.deleteData');
    });
});

Route::middleware(['auth:api'])->group(function () {
    Route::prefix('/apprenant/sondage')->group(function () {
        Route::get("/list", [EvalSondageController::class, "getSondageList"])->name('api.sondage.apprenant.retrieve');
        Route::get("/{id}", [EvalSondageController::class, "getDataSpecific"])->name('api.sondage.apprenant.retrieve');
        Route::post("/{id}/answer", [EvalSondageController::class, "answerSondage"])->name('api.sondage.apprenant.retrieve');
        Route::get("/{userId}/{sondageId}", [EvalSondageController::class, "getSpecificSondage"])->name('api.sondage.apprenant.retrieve');
    });
});
