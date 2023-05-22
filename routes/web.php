<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
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

Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');

Route::resource('tasks', TasksController::class);
Route::get('/', WelcomeController::class)->name('welcome');

Auth::routes();
