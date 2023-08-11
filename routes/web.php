<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PolygonController;
use App\Http\Controllers\UserVehicleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;


Route::group(['middleware' => ['auth', 'role:admin']], function () {
    // Admins routes

    // Maps Crud
    Route::get('/maps', [PolygonController::class, 'showMap'])->name('maps');
    Route::get('/load-polygons', [PolygonController::class, 'loadPolygons'])->name('load.polygons');
    Route::post('/save-polygon', [PolygonController::class, 'storePolygon'])->name('save.polygon');
    Route::post('/delete-polygon', [PolygonController::class, 'deletePolygon'])->name('delete.polygon');
// Users Crud
    Route::get('/user-management', [AdminController::class, 'userManagement'])->name('user.management');
    Route::post('/save-user', [AdminController::class, 'saveUser'])->name('user.save');
    Route::get('/edit-user/{user}', [AdminController::class, 'editUser'])->name('user.edit');
    Route::get('/create-user', [AdminController::class, 'createUser'])->name('user.create');
    Route::delete('/user-delete/{user}', [AdminController::class, 'deleteUser'])->name('user.delete');
});


// Theme generated routes
Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');


Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
// vehicle CRUD
Route::post('/save-vehicle', [UserVehicleController::class, 'saveVehicle'])->name('vehicle.save');
Route::get('/edit-vehicle{vehicleId}', [UserVehicleController::class, 'editProfile'])->name('vehicle.edit');
Route::get('/create-vehicle', [UserVehicleController::class, 'createVehicle'])->name('vehicle.create');
Route::delete('/delete-vehicle{vehicleId}/', [UserVehicleController::class, 'deleteVehicle'])->name('vehicle.delete');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
    Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
    Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
    Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
    Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
    Route::get('/{page}', [PageController::class, 'index'])->name('page');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
