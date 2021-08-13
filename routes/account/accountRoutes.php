<?php
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| User account routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:api'])->prefix('user')->group(function () {
    Route::get('/{id}', [UserController::class, 'getUser']);
    Route::post('/update', [UserController::class, 'updateUser']);
    Route::post('/update/password', [UserController::class, 'updatePassword']);
    Route::post('/image/update', [UserController::class, 'updateAvatar']);
});
