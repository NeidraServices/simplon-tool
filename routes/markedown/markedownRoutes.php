<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Md_CategoryController;
use App\Http\Controllers\Md_CommentaryController;


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

Route::get('categories', [Md_CategoryController::class, 'index']);
Route::group(['prefix' => 'categorie'], function () {
    Route::post('ajouter', [Md_CategoryController::class, 'create']);
    Route::put('modifier/{id}', [Md_CategoryController::class, 'edit']);
    Route::delete('supprimer/{id}', [Md_CategoryController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Markdown Commentary routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});

Route::get('commentaires', [Md_CommentaryController::class, 'index']);

Route::group(['prefix' => 'commentaire'], function(){
    Route::post('ajouter/{markdown_id}', [Md_CommentaryController::class, 'store']);
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