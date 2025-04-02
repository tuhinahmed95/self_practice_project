<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
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
Route::get('/category/soft/delete/{id}', [CategoryController::class,'category_soft_delete'])->name('category.soft.delete');
Route::get('/category/trash/list', [CategoryController::class,'category_trash_list'])->name('category.trash.list');
Route::get('/category/restore/{id}', [CategoryController::class,'category_restore'])->name('category.restore');
Route::get('/category/permanent/delete/{id}', [CategoryController::class,'category_permanent_delete'])->name('category.permanent.delete');
Route::post('/category/ceheck/delete', [CategoryController::class,'category_check_delete'])->name('category.check.delete');
Route::post('/category/bulk/action', [CategoryController::class,'category_bulk_action'])->name('category.bulk.action');


// SubCategory
Route::get('/subcategory/list', [SubcategoryController::class,'subcategory_list'])->name('subcategory.list');
Route::get('/subcategory/create', [SubcategoryController::class,'subcategory_create'])->name('subcategory.create');
Route::post('/subcategory/store', [SubcategoryController::class,'subcategory_store'])->name('subcategory.store');
Route::get('/subcategory/edit/{id}', [SubcategoryController::class,'subcategory_edit'])->name('subcategory.edit');
Route::post('/subcategory/update/{id}', [SubcategoryController::class,'subcategory_update'])->name('subcategory.update');
Route::get('/subcategory/soft/delete/{id}', [SubcategoryController::class,'subcategory_soft_delete'])->name('subcategory.soft.delete');
Route::get('/subcategory/trash/list', [SubcategoryController::class,'subcategory_trash_list'])->name('subcategory.trash.list');
Route::get('/subcategory/restore/{id}', [SubcategoryController::class,'subcategory_restore'])->name('subcategory.restore');
Route::get('/subcategory/permanent/delete/{id}', [SubcategoryController::class,'subcategory_permanent_delete'])->name('subcategory.permanent.delete');
Route::post('/subcategory/check/delete', [SubcategoryController::class,'subcategory_check_delete'])->name('subcategory.check.delete');
Route::post('/subcategory/bulk/action', [SubcategoryController::class,'subcategory_bulk_action'])->name('subcategory.bulk.action');

// Brand
Route::get('/brand/list', [BrandController::class, 'brand_list'])->name('brand.list');
Route::get('/brand/create', [BrandController::class, 'brand_create'])->name('brand.create');
Route::post('/brand/store', [BrandController::class, 'brand_store'])->name('brand.store');
Route::get('/brand/edit/{id}', [BrandController::class, 'brand_edit'])->name('brand.edit');
Route::post('/brand/update/{id}', [BrandController::class, 'brand_update'])->name('brand.update');
Route::get('/brand/soft/delete/{id}', [BrandController::class, 'brand_soft_delete'])->name('brand.soft.delete');
Route::get('/brand/trash/list', [BrandController::class, 'brand_trash_list'])->name('brand.trash.list');
Route::get('/brand/restore/{id}', [BrandController::class, 'brand_restore'])->name('brand.restore');
Route::get('/brand/permanent/delete/{id}', [BrandController::class, 'brand_permanent_delete'])->name('brand.permanenet.delete');
Route::post('/brand/check/delete',[ BrandController::class, 'brand_check_delete'])->name('brand.check.delete');
Route::post('/brand/bulk/action',[ BrandController::class, 'brand_bulk_action'])->name('brand.bulk.action');
