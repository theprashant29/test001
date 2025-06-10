<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\SubCategoriesController;
use App\Http\Controllers\Admin\TasksController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('/user/dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [UserHomeController::class, 'index'])->name('user.home');
    Route::post('/store-options', [UserHomeController::class, 'storeSelectedOptions'])->name('user.store.options');
});




Route::prefix('admin')->middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.index');
    
    Route::resource('categories', CategoriesController::class);
    Route::resource('sub-categories', SubCategoriesController::class);
    Route::resource('user', UserController::class);
    Route::resource('tasks', TasksController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';
