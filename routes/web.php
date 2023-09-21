<?php

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
    return view('welcome');
});

// bejelentkezés weblap elérése
Route::get('/bejelentkezes', function () {
   return view('bejelentkezes');
});

// később ezek a route-ok egy Controllerben lesznek kifejtve ebben a formában:
// Route::get('/bejelentkezes', [BejelentkezesController::class, 'bejelentkezes'])->name('bejelentkezes');