<?php

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
Route::get('/subjects/{subject}', [SubjectController::class, 'show'])->name('subjects.show');
Route::get('/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');
