<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvalLangageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Deliver_ProjetController;
use App\Http\Controllers\Deliver_CommentairesController;
use App\Http\Controllers\Deliver_CompetenceController;
use App\Http\Controllers\Deliver_MediaController;
use App\Http\Controllers\Deliver_TagController;
use App\Http\Controllers\EvalCoorteController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/*
|--------------------------------------------------------------------------
| Authentication routes
|--------------------------------------------------------------------------
*/

Route::post('/connexion', [AuthController::class, 'connexion'])->name('api.connexion');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('api.logout');
Route::post('/email/verification', [AuthController::class, 'verifymail'])->name('api.verify.email');
Route::post('/verify', [AuthController::class, 'verifyToken'])->middleware(['auth:api'])->name('api.verify.token');


/*
|--------------------------------------------------------------------------
| Evaluation360 Routes routes
|--------------------------------------------------------------------------
*/

Route::prefix('/evaluation360')->group(__DIR__ . '/evaluation360/evalRoutes.php');

/*
|--------------------------------------------------------------------------
| Deliver routes
|--------------------------------------------------------------------------
*/

Route::prefix('/deliver')->group(__DIR__ . '/deliver/deliverRoutes.php');

/*
|--------------------------------------------------------------------------
| Markdown archive routes
|--------------------------------------------------------------------------
*/

Route::prefix('/markedown')->group(__DIR__ . '/markedown/markedownRoutes.php');

/*
|--------------------------------------------------------------------------
| Users routes
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
