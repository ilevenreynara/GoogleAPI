<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\ClassroomController;

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

# Routes
Route::middleware(['auth:sanctum', 'verified', 'middleware' => 'auth'])->group(function () {
    Route::get('/', function() {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/calendar', [AnnouncementsController::class, 'index'])->name('calendar');
    Route::post('/calendar/store', [AnnouncementsController::class, 'store']);
    Route::post('/calendar/update', [AnnouncementsController::class, 'update']);
    Route::post('/calendar/delete', [AnnouncementsController::class, 'delete']);
    Route::get('/classroom',[ClassroomController::class, 'index'])->name('classroom');
});

# Authentication
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);