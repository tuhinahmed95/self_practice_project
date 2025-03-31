<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontendController::class, 'welcome'])->name('welcome');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// User Update
Route::get('/user/profile', [UserController::class, 'user_profile'])->name('user.profile');
Route::post('/user/profile/update', [UserController::class,'user_profile_update'])->name('user.profile.update');
Route::post('/user/password/update', [UserController::class,'user_password_update'])->name('user.password.update');
Route::post('/user/photo/update', [UserController::class,'user_photo_update'])->name('user.photo.update');

// User Crete
Route::get('/user/list', [UserController::class,'user_list'])->name('user.list');
Route::get('/user/create', [UserController::class,'user_create'])->name('user.create');
Route::post('/user/store', [UserController::class,'user_store'])->name('user.store');
Route::get('/user/delete/{id}', [UserController::class,'user_delete'])->name('user.delete');


// Category
Route::get('/category/list', [CategoryController::class,'category_list'])->name('category.list');
Route::get('/category/create', [CategoryController::class,'category_create'])->name('category.create');
Route::post('/category/store', [CategoryController::class,'category_store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class,'category_edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class,'category_update'])->name('category.update');
Route::get('/category/delete/{id}', [CategoryController::class,'category_delete'])->name('category.delete');
