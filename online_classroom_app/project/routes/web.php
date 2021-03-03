<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('cources.comments', App\Http\Controllers\CommentController::class)
    ->middleware('auth');
Route::resource('courses', \App\Http\Controllers\CourseController::class)
    ->middleware('auth');
Route::resource('courses.lessons', \App\Http\Controllers\CourseController::class)
    ->middleware('auth');
Route::resource('courses.course_profiles', \App\Http\Controllers\CourseController::class)
    ->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
