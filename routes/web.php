<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\ParticipantsController;
use App\Http\Controllers\ProfessionalsController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\ContactProfessionalController;
use App\Http\Controllers\ForumsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FormRepliesController;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/check-text', [BadWordsController::class, 'checkText']);


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/activities', [ParticipantsController::class, 'index'])->middleware(['auth', 'verified'])->name('activities.dashboard');
Route::get('/dashboard/forums', [ForumsController::class, 'myForums'])->middleware(['auth', 'verified'])->name('forums.dashboard');
Route::get('/dashboard/forums/edit/{id}', [ForumsController::class, 'edit'])->name('dashboard.forums.edit');
Route::put('/dashboard/forums/update/{id}', [ForumsController::class, 'update'])->name('update.dashboard');
Route::delete('/dashboard/forums/delete/{id}', [ForumsController::class, 'delete'])->name('dashboard.forums.delete');


Route::get('/mails', [ContactProfessionalController::class, 'index'])->middleware(['auth', 'verified'])->name('mails');
Route::get('/mail/{id}', [ContactProfessionalController::class, 'detail']);

/*Forums*/
Route::get('/forums/category/{category_id}', [ForumsController::class, 'filterByCategory']);
Route::get('/forums/search', [ForumsController::class, 'search'])->name('forums.search');


Route::get('/forums', [ForumsController::class, 'index'])->name('forums');
Route::get('/forum/{id}', [ForumsController::class, 'detail']);

Route::post('/forum/{id}/answer', [FormRepliesController::class, 'store'])->middleware('auth')->name('answer');
Route::get('/forum/{id}', [ForumsController::class, 'detail'])->name('forums.detail');

Route::get('/forum/{id}/answer/{answer_id}/edit', [ForumsController::class, 'editAnswer'])->middleware('auth');
Route::patch('/forum/{id}/answer/{answer_id}/edit', [ForumsController::class, 'updateAnswer'])->middleware('auth');
Route::delete('/forum/{id}/answer/{answer_id}', [ForumsController::class, 'deleteAnswer'])->middleware('auth');


Route::get('/forums/create', [ForumsController::class, 'create'])->middleware('auth');
Route::post('/forums', [ForumsController::class, 'store'])->middleware('auth');


/* Blogs */
Route::get('/blogs/search', [BlogsController::class, 'search'])->name('blogs.search');
Route::get('/blogs/category/{category_id}', [BlogsController::class, 'filterByCategory']);


Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs');
Route::get('/blog/{id}', [BlogsController::class, 'detail']);

Route::get('/blogs/create', [BlogsController::class, 'create'])->middleware('auth');
Route::post('/blogs', [BlogsController::class, 'store'])->middleware('auth');

Route::delete('/blogs/{id}', [BlogsController::class, 'delete'])->middleware('auth');

Route::patch('/blog/{id}/edit', [BlogsController::class, 'update'])->middleware('auth');
Route::get('/blog/{id}/edit', [BlogsController::class, 'edit'])->middleware('auth');

/* Activities */
Route::get('/activities', [ActivitiesController::class, 'index'])->name('activities');
Route::get('/activity/{id}', [ActivitiesController::class, 'detail']);

Route::get('/activities/create', [ActivitiesController::class, 'create'])->middleware('auth');
Route::post('/activities', [ActivitiesController::class, 'store'])->middleware('auth');

Route::delete('/activities/{id}', [ActivitiesController::class, 'delete'])->middleware('auth');

Route::patch('/activity/{id}/edit', [ActivitiesController::class, 'update'])->middleware('auth');
Route::get('/activity/{id}/edit', [ActivitiesController::class, 'edit'])->middleware('auth');

Route::get('/activity/{id}/participate', [ParticipantsController::class, 'create'])->name('activity.participate');
Route::post('/activity/participate', [ParticipantsController::class, 'store'])->name('activity.participate.store');
Route::get('/confirm/{id}', [ParticipantsController::class, 'confirm']);
Route::get('/delete/{id}', [ParticipantsController::class, 'delete']);
Route::get('/cancel/{id}', [ParticipantsController::class, 'cancel']);

/* Professionals */
Route::get('/professionals', [ProfessionalsController::class, 'index'])->name('professionals');
Route::get('/professional/{id}', [ProfessionalsController::class, 'detail']);

Route::get('/professionals/contact/{id}', [ContactProfessionalController::class, 'create'])->name('professionals.contact');
Route::post('/professionals/contact', [ContactProfessionalController::class, 'store'])->name('professionals.contact.store');




/* FAQ */
Route::get('/questions', [QuestionsController::class, 'index'])->name('questions');

/* Profile */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
