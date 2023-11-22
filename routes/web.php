<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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
Route::post('/sign-in', [UserController::class, 'sign_in_post'])->name('sign-in.post');

// regisztráció weblap elérése
Route::get('/sign-up', [UserController::class, 'sign_up'])->name('sign-up');
Route::post('/sign-up', [UserController::class, 'sign_up_post'])->name('sign-up.post');

// elfelejtett jelszó weblap elérése
Route::get('/forgot-psw', [UserController::class, 'forgot_psw'])->name('forgot-psw');
Route::post('/forgot-psw', [UserController::class, 'forgot_psw_post'])->name('forgot-psw.post');

// reset password
Route::get('/reset-psw/{token}', [UserController::class, 'reset_psw'])->name('reset-psw');
Route::post('/reset-psw', [UserController::class, 'reset_psw_post'])->name('reset-psw.post');

// tanárok weblap
Route::get('/main', [UserController::class, 'main'])->name('main-screen');
// rólunk weblap
Route::get('/about-us', [UserController::class, 'about_us'])->name('about-us');

Route::get('/sign-out', [UserController::class, 'sign_out'])->name('sign-out');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
