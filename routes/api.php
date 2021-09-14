<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
Route::post('password/email', [ForgotPasswordController::class, 'forgot']);
Route::post('password/reset', [ForgotPasswordController::class, 'reset']);

/*
|--------------------------------------------------------------------------
| User account routes
|--------------------------------------------------------------------------
*/

Route::prefix('/account')->group(__DIR__ . '/account/accountRoutes.php');
/*

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
