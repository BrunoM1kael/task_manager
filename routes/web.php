<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['Authenticate', 'role']], function () {

    Route::resource('/task', TaskController::class);
    Route::get('/sair', function () {
        Auth::logout();
        return redirect('/' . env('APP_FOLDER', ''));
    })->name('logout');

    Route::get('/change-password', [UserController::class, 'changepassword'])->name('user.changepassword');
    Route::post('/change-password', [UserController::class, 'changedpassword'])->name('user.changedpassword');
});

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'login']);

Route::get('/register', [UserController::class, 'create'])->name('user.create');
Route::post('/register', [UserController::class, 'store'])->name('user.store');
