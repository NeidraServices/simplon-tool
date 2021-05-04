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

Route::prefix('/evaluation360')->group(__DIR__.'/evaluation360/evalRoutes.php');

/*
|--------------------------------------------------------------------------
| Deliver routes
|--------------------------------------------------------------------------
*/

Route::prefix('/deliver')->group(__DIR__.'/deliver/deliverRoutes.php');

/*
|--------------------------------------------------------------------------
| Markdown archive routes
|--------------------------------------------------------------------------
*/

Route::prefix('/markedown')->group(__DIR__.'/markedown/markdownRoutes.php');