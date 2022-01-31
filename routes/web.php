<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\QuestionController as ControllersQuestionController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

// Auth
Route::get('quiz/{topic?}', [QuestionController::class, 'index'])
    ->name('quiz');
    // ->middleware('auth');

Route::post('/question/{question}/answer/{choice}', [QuestionController::class, 'checkAnswer']);
// ->name('check')
// ->middleware('auth');

Route::get('/questions/topic/{topic}', [QuestionController::class, 'getByTopic'])->name('questions');

Route::get('/subject/{subject}/topics', [SubjectController::class, 'getTopicsBySubject'])->name('subject_topics');


Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Dashboard

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Users

Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');

// Questions

Route::get('questions', [ControllersQuestionController::class, 'index'])
    ->name('questions')
    ->middleware('auth');

Route::get('questions/create', [ControllersQuestionController::class, 'create'])
    ->name('questions.create')
    ->middleware('auth');

Route::post('questions', [ControllersQuestionController::class, 'store'])
    ->name('questions.store')
    ->middleware('auth');

Route::get('questions/{question}/edit', [ControllersQuestionController::class, 'edit'])
    ->name('questions.edit')
    ->middleware('auth');

Route::put('questions/{question}', [ControllersQuestionController::class, 'update'])
    ->name('questions.update')
    ->middleware('auth');

Route::delete('questions/{question}', [ControllersQuestionController::class, 'destroy'])
    ->name('questions.destroy')
    ->middleware('auth');

Route::put('questions/{question}/restore', [ControllersQuestionController::class, 'restore'])
    ->name('questions.restore')
    ->middleware('auth');

// Contacts

// Route::get('contacts', [ContactsController::class, 'index'])
//     ->name('contacts')
//     ->middleware('auth');

// Route::get('contacts/create', [ContactsController::class, 'create'])
//     ->name('contacts.create')
//     ->middleware('auth');

// Route::post('contacts', [ContactsController::class, 'store'])
//     ->name('contacts.store')
//     ->middleware('auth');

// Route::get('contacts/{contact}/edit', [ContactsController::class, 'edit'])
//     ->name('contacts.edit')
//     ->middleware('auth');

// Route::put('contacts/{contact}', [ContactsController::class, 'update'])
//     ->name('contacts.update')
//     ->middleware('auth');

// Route::delete('contacts/{contact}', [ContactsController::class, 'destroy'])
//     ->name('contacts.destroy')
//     ->middleware('auth');

// Route::put('contacts/{contact}/restore', [ContactsController::class, 'restore'])
//     ->name('contacts.restore')
//     ->middleware('auth');

// // Reports

// Route::get('reports', [ReportsController::class, 'index'])
//     ->name('reports')
//     ->middleware('auth');

// Images

// Route::get('/img/{path}', [ImagesController::class, 'show'])
//     ->where('path', '.*')
//     ->name('image');

