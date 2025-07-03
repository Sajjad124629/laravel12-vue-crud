<?php

use App\Http\Controllers\PersonController;
use App\Http\Controllers\PostController;
use App\Models\Person;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    $people = Person::all();
    return Inertia::render('Dashboard',['people' => $people]);
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('post',[PostController::class,'index'])->name('post.index');
    Route::get('post-create',[PostController::class,'create'])->name('post.create');
    Route::post('post-store',[PostController::class,'store'])->name('post.store');
    Route::get('post-edit/{id}',[PostController::class,'edit'])->name('post.edit');
    Route::post('post-update/{id}',[PostController::class,'update'])->name('post.update');
    Route::get('post-delete/{id}',[PostController::class,'destroy'])->name('post.delete');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
