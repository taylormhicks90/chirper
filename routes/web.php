<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\Chirps\ChirpLikesController;
use App\Http\Controllers\UsersController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('chirps', ChirpController::class)
         ->only(['index', 'store', 'update', 'destroy']);

    Route::patch('/chirps/{chirp}/like', [ChirpLikesController::class,'store'])->name('chirps.like.store');
    Route::delete('/chirps/{chirp}/like',[ChirpLikesController::class,'destroy'])->name('chirps.like.delete');

Route::resource('chirps.likes', ChirpLikesController::class)
    ->only(['store','destroy'])
    ->middleware(['auth','verified']);

Route::post('/chirp/{chirp}/toggle', [ChirpLikesController::class, 'toggle'])->name('chirp.toggle');

Route::resource('users', UsersController::class)
    ->only(['index','show'])
    ->middleware(['auth','verified']);

require __DIR__.'/auth.php';
