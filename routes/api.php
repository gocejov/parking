<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserSettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PolygonController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('guest')->group(function (){
    Route::post('/register', [RegisterController::class, 'apiStore']);
    Route::post('/login', [LoginController::class, 'apiLogin']);
});

Route::middleware('auth:api')->group(function (){

    // User Settings Routes
    Route::get('/user/settings', [UserSettingsController::class, 'index']);
    Route::post('/user/settings/store', [UserSettingsController::class, 'store']);
    Route::put('/user/settings/{settings}',[UserSettingsController::class, 'update']);
    Route::delete('/user/settings/{settings}',[UserSettingsController::class, 'destroy']);
// User Profile Routes
    Route::post('/profile', [UserProfileController::class, 'apiUpdate']);

    // Polygon Routes
    Route::post('/check-points', [PolygonController::class, 'isPointInPolygon']);


});



