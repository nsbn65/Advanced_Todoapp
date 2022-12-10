<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/',[PostController::class,'index']);
Route::post('/create',[PostController::class,'create'])->name('todo.create');
Route::post('/update/{id}',[PostController::class,'update'])->name('todo.update');
Route::post('/delete/{id}',[PostController::class,'delete'])->name('todo.delete');
Route::post('/logout',[PostController::class,'logout'])->name('todo.logout');
Route::get('/search', [PostController::class,'search'])->name('todo.search');

Route::get('/find', [PostController::class,'find'])->name('todo.find');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
