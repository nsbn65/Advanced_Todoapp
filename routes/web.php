<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/',[PostController::class,'index'])->middleware('auth');
Route::post('/create',[PostController::class,'create'])->name('todo.create')->middleware('auth');
Route::post('/update/{id}',[PostController::class,'update'])->name('todo.update')->middleware('auth');
Route::post('/delete/{id}',[PostController::class,'delete'])->name('todo.delete')->middleware('auth');
Route::post('/logout',[PostController::class,'login'])->name('todo.logout')->middleware('auth');
Route::get('/search', [PostController::class,'search'])->name('todo.search')->middleware('auth');
Route::post('/find', [PostController::class,'find'])->name('todo.find')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
