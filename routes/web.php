<?php


use App\Http\Controllers\Chirps\ChirpController;
use App\Http\Controllers\Chirps\FetchChirpsController;
use App\Http\Controllers\Chirps\LikeChirpsController;
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
    Route::patch('/like/{chirp}', LikeChirpsController::class)->name('chirps.like');

    Route::get('chirps.fetch', FetchChirpsController::class)->name('chirps.fetch');
    Route::resource('users', UsersController::class)
         ->only(['index', 'show']);
});
require __DIR__ . '/auth.php';
