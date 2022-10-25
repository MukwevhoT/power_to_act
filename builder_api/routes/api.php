<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('auth')->group(function () {
    Route::post('/register',[RegisterController::class,'register']);
    Route::post('/login',[LoginController::class,'login']);

    Route::prefix('password')->group(function () {
        Route::post('/forgot',[ForgotPasswordController::class,'sendResetLinkEmail']);
        Route::post('/reset',[ResetPasswordController::class,'reset'])->name('password.reset');
    });
    
    Route::middleware('auth:api_user')->group(function () {
        Route::get('/', fn (Request $request) => $request->user());
		Route::get('/logout', [LoginController::class, 'logout']);

    });
});

// Route::prefix('project')->group(function () {
//     Route::middleware('auth:api_user')->group(function () {
//         Route::post('/add',[ProjectController::class,'add_project']);
//         Route::get('/',[ProjectController::class, 'retrieve']);
//     });
// });
Route::prefix('project')->group(function () {
        Route::post('/add',[ProjectController::class,'add_project']);
        Route::get('/',[ProjectController::class, 'retrieve']);
        Route::post('/update',[ProgressController::class,'update']);
});
