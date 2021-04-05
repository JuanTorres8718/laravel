<?php


use App\Http\Livewire\UsersTable;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Livewire\Resultados;
use App\Http\Livewire\Firmas;
// use App\Http\Controllers\FirmasController;


use Illuminate\Routing\Route as RoutingRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Ruta para USERS via clase UsersTable que conectará directamente con la clase 
// que renderizará la vista
Route::middleware(['auth:sanctum', 'verified'])
    ->get('/users', UsersTable::class)
    ->name('users');

// The Email Verification Notice
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

// The Email Verification Handler
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resending The Verification Email

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// The Password Reset Link Request Form

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware(['guest'])->name('password.request');

// Route::middleware(['auth:sanctum', 'verified'])
//     ->get('/resultado', Resultados::class)
//     ->name('resultado');

//     Route::middleware(['auth:sanctum', 'verified'])
//     ->get('/proyecto', Proyectotable::class)
//     ->name('proyecto');

     Route::middleware(['auth:sanctum', 'verified'])
    ->get('/firma', Firmas::class)
    ->name('firma');

    // Route::get('/firma', [FirmasController::class, 'store'])->name('firma');

    // Route::get('firma', FirmasController::class);
    Route::middleware(['auth:sanctum', 'verified'])
    ->get('/resultado', Resultados::class)
    ->name('resultado');