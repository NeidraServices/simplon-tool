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

Route::get('/apprenants', [EvalCoorteController::class, 'getData'])->middleware('auth:api')->name('api.coort.retrieve');
Route::post('/apprenants/filter', [EvalCoorteController::class, 'filterApprenant']);

Route::middleware(['auth:api', "role:1,2"])->group(function () {
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


Route::get("/list", [EvalPromotionController::class, "getData"])->middleware('auth:api')->name('api.promotion.retrieve');

Route::middleware(['auth:api', "role:1,2"])->prefix("promotion")->group(function () {
    Route::post("/create", [EvalPromotionController::class, "addData"])->name('api.promotion.create');
    Route::put("/{id}/update", [EvalPromotionController::class, "updateData"])->name('api.promotion.update');
    Route::delete("/{id}/delete", [EvalPromotionController::class, "deleteData"])->name('api.promotion.delete');
});


/*
|--------------------------------------------------------------------------
| Evaluation360 Référentiel routes
|--------------------------------------------------------------------------
*/


Route::get("/list", [EvalReferentielController::class, "getData"])->middleware('auth:api')->name('api.referentiel.retrieve');

Route::middleware(['auth:api', "role:1,2"])->prefix("/referentiel")->group(function () {
    Route::post("/create", [EvalReferentielController::class, "addData"])->name('api.referentiel.create');
    Route::put("/{id}/update", [EvalReferentielController::class, "updateData"])->name('api.referentiel.update');
    Route::delete("/{id}/delete", [EvalReferentielController::class, "deleteData"])->name('api.referentiel.delete');
});

/*
|--------------------------------------------------------------------------
| Evaluation360 Skill routes
|--------------------------------------------------------------------------
*/

Route::get("/list", [EvalSkillController::class, "getData"])->middleware('auth:api')->name('api.skill.retrieve');

Route::middleware(['auth:api', "role:1,2"])->prefix("/skill")->group(function () {
    Route::post("/create", [EvalSkillController::class, "addData"])->name('api.skill.create');
    Route::put("/{id}/update", [EvalSkillController::class, "updateData"])->name('api.skill.update');
    Route::delete("/{id}/delete", [EvalSkillController::class, "deleteData"])->name('api.skill.delete');
});


/*
|--------------------------------------------------------------------------
| Evaluation360 Langages routes
|--------------------------------------------------------------------------
*/

Route::get("/list", [EvalLangageController::class, "getData"])->middleware('auth:api')->name('api.langage.retrieve');

Route::middleware(['auth:api', "role:1,2"])->prefix("/langage")->group(function () {
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

Route::middleware(['auth:api', "role:1,2"])->group(function () {
    Route::prefix("/formateur/sondage")->group(function () {
        Route::get("/list", [EvalSondageController::class, "getDataAll"])->name('api.sondage.formateur.retrieve');
    });

    Route::prefix('/sondage')->group(function () {
        Route::put("{id}/proposing/accepte", [EvalSondageController::class, "acceptProposing"])->name('api.sondage.formateur.acceptProposing');
    });
});

Route::middleware(['auth:api'])->group(function () {
    Route::prefix('/sondage')->group(function () {
        Route::post("/create", [EvalSondageController::class, "addData"])->name('api.sondage.formateur.create');
        Route::put("/update", [EvalSondageController::class, "updateData"])->name('api.sondage.formateur.updateData');
        Route::put("/draft", [EvalSondageController::class, "setToDraft"])->name('api.sondage.formateur.setToDraft');
        Route::put("/publish", [EvalSondageController::class, "setToPublish"])->name('api.sondage.formateur.setToPublish');
        Route::delete("/{name}/delete", [EvalSondageController::class, "deleteData"])->name('api.sondage.formateur.deleteData');
    });
});

Route::middleware(['auth:api'])->group(function () {
    Route::prefix('/apprenant/sondage')->group(function () {
        Route::get("/list", [EvalSondageController::class, "getSondageList"])->name('api.sondage.apprenant.one');
        Route::get("/{id}", [EvalSondageController::class, "getDataSpecific"])->name('api.sondage.apprenant.two');
        Route::post("/{id}/answer", [EvalSondageController::class, "answerSondage"])->name('api.sondage.apprenant.three');
        Route::get("/{userId}/{sondageId}", [EvalSondageController::class, "getSpecificSondage"])->name('api.sondage.apprenant.four');
    });
});
