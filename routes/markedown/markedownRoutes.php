<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Md_CategoryController;
use App\Http\Controllers\Md_MarkdownController;
use App\Http\Controllers\Md_CommentaryController;
use App\Http\Controllers\Md_ArchiveController;


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
Route::get('markdowns-commun', [Md_MarkdownController::class, 'show']);
Route::get('my-markdowns', [Md_MarkdownController::class, 'show']);
Route::get('my-archives', [Md_MarkdownController::class, 'show']);
Route::group(['prefix' => 'categorie'], function () {
    Route::get('/search', [Md_CategoryController::class, 'search']);
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
Route::prefix('/markdown')->group(function () {
    Route::post('/create', [Md_MarkdownController::class, 'create'])->name('api.md_wiki.markdown.create');
    Route::post('/active/{id}', [Md_MarkdownController::class, 'updateActive'])->name('api.md_wiki.markdown.active');
    Route::post('/category/{id}', [Md_MarkdownController::class, 'updateCategory'])->name('api.md_wiki.markdown.category');
    Route::get('/show', [Md_MarkdownController::class, 'show'])->name('api.md_wiki.markdown.show');
    Route::post('/update/title/{id}', [Md_MarkdownController::class, 'updateTitle'])->name('api.md_wiki.markdown.update.title');
    Route::post('/update/description/{id}', [Md_MarkdownController::class, 'updateDescription'])->name('api.md_wiki.markdown.update.description');
    Route::get('/archives/{id}', [Md_ArchiveController::class, 'show'])->name('api.md_wiki.markdown.archives.index');  
    Route::post('/edit/{id}', [Md_MarkdownController::class, 'editMd'])->name('api.md_wiki.markdown.edit');
    Route::get('/{id}', [Md_MarkdownController::class, 'index'])->name('api.md_wiki.markdown.index');  
});
/*
|--------------------------------------------------------------------------
| Markdown user routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->group(function(){

});