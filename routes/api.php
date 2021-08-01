<?php

use Illuminate\Http\Request;
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


// /*
// |--------------------------------------------------------------------------
// | Evaluation360 Routes routes
// |--------------------------------------------------------------------------
// */

// Route::prefix('/evaluation360')->group(__DIR__ . '/evaluation360/evalRoutes.php');

// /*
// |--------------------------------------------------------------------------
// | Deliver routes
// |--------------------------------------------------------------------------
// */

// Route::prefix('/deliver')->group(__DIR__ . '/deliver/deliverRoutes.php');

// /*
// |--------------------------------------------------------------------------
// | Markdown archive routes
// |--------------------------------------------------------------------------
// */

<<<<<<< HEAD
// Route::prefix('/markedown')->group(__DIR__ . '/markedown/markedownRoutes.php');

// /*
// |--------------------------------------------------------------------------
// | Users routes
// |--------------------------------------------------------------------------
// */


Route::middleware(['auth:api'])->prefix('user')->group(function () {
  Route::get('/{id}', [UserController::class, 'getUser'])->where('id', "[0-9]+");
  Route::post('/update', [UserController::class, 'updateUser']);
  Route::post('/update/password', [UserController::class, 'updatePassword']);
  Route::post('/image/update', [UserController::class, 'updateAvatar']);
});

Route::middleware(['auth:api'])->prefix("/apprenants")->group(function () {
  Route::get('/', [EvalCoorteController::class, 'getData'])->name('api.coort.retrieve');
  Route::post('/create', [EvalCoorteController::class, 'addData'])->name('api.coort.addData');
  Route::put('/{id}/update', [EvalCoorteController::class, 'updateData'])->name('api.coort.updateData');
  Route::delete('/{id}/delete', [EvalCoorteController::class, 'deleteData'])->name('api.coort.delete');
  Route::post('/filter', [EvalCoorteController::class, 'filterApprenant']);
});

Route::middleware(['auth:api'])->group(function() {
  Route::get('/user/{id}', [UserController::class, 'getUser'])->where('id', "[0-9]+");
  Route::get('/notes/{userId}', [EvalSondageController::class,'getNotes']);
  Route::post('/user/update', [UserController::class, 'updateUser']);
  Route::post('/user/update/password', [UserController::class, 'updatePassword']);
});
=======
Route::prefix('/markedown')->group(__DIR__ . '/markedown/markedownRoutes.php');
<<<<<<< HEAD

=======
>>>>>>> aa5465b195b5b099cda4572846c11d5ec7887d8b
>>>>>>> 26474a80a69fd7f1e405499357de798399b89c95
