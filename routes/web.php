<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\ParticipantsController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs');
Route::get('/blog/{id}', [BlogsController::class, 'detail']);
Route::get('/blogs/create', [BlogsController::class, 'create'])->middleware('auth');
Route::post('/blogs', [BlogsController::class, 'store'])->middleware('auth');
Route::delete('/blogs/{id}', [BlogsController::class, 'delete'])->middleware('auth');
Route::get('/blog/{id}/edit', [BlogsController::class, 'edit'])->middleware('auth');

Route::get('/activities', [ActivitiesController::class, 'index'])->name('activities');
Route::get('/activity/{id}', [ActivitiesController::class, 'detail']);
Route::get('/activity/{id}/participate', [ParticipantsController::class, 'create'])->name('activity.participate');
Route::post('/activity/participate', [ParticipantsController::class, 'store'])->name('activity.participate.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
