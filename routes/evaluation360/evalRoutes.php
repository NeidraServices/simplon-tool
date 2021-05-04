<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvalLangageController;
use App\Models\EvalPromotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::get("/promotion/list", [EvalPromotion::class, "getData"])->name('api.promotion.retrive');
    Route::post("/promotion/create", [EvalPromotion::class, "addData"])->name('api.promotion.create');
    Route::put("/promotion/{id}/update", [EvalPromotion::class, "updateData"])->name('api.promotion.update');
    Route::delete("/promotion/{id}/delete", [EvalPromotion::class, "deleteData"])->name('api.promotion.delete');
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
    Route::get("/langage/list", [EvalLangageController::class, "getData"])->name('api.langage.retrive');
    Route::post("/langage/create", [EvalLangageController::class, "addData"])->name('api.langage.create');
    Route::put("/langage/{id}/update", [EvalLangageController::class, "updateData"])->name('api.langage.update');
    Route::delete("/langage/{id}/delete", [EvalLangageController::class, "deleteData"])->name('api.langage.delete');
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
