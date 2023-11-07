<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
   return redirect('/sign-in');
});

Route::get('/welcome', [UserController::class, 'welcome'])->name('welcome');

// bejelentkezés weblap elérése
Route::get('/sign-in', [UserController::class, 'sign_in'])->name('sign-in');
Route::post('/sign-in', [UserController::class, 'sign_in_post'])->name('sign-in.post');

// regisztráció weblap elérése
Route::get('/sign-up', [UserController::class, 'sign_up'])->name('sign-up');
Route::post('/sign-up', [UserController::class, 'sign_up_post'])->name('sign-up.post');

// elfelejtett jelszó weblap elérése
Route::get('/forgot-psw', [UserController::class, 'forgot_psw'])->name('forgot-psw');
Route::post('/forgot-psw', [UserController::class, 'forgot_psw_post'])->name('forgot-psw.post');

Route::get('/sign-out', [UserController::class, 'sign_out'])->name('sign-out');