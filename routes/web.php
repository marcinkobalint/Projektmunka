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

// bejelentkezés weblap elérése
Route::get('/sign-in', [UserController::class, 'sign_in'])->name('sign-in');

// regisztráció weblap elérése
Route::get('/sign-up', [UserController::class, 'sign_up'])->name('sign-up');

// elfelejtett jelszó weblap elérése
Route::get('/forgot-psw', [UserController::class, 'forgot_psw'])->name('forgot-psw');

// később ezek a route-ok egy Controllerben lesznek kifejtve ebben a formában:
// Route::get('/bejelentkezes', [BejelentkezesController::class, 'bejelentkezes'])->name('bejelentkezes');