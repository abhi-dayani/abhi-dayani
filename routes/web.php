<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Models\Sub_categories;
use Illuminate\Support\Facades\Auth;
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

Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

// Users Routes
Route::get('/admin/users', [UserController::class, 'listUsers'])->middleware(['auth'])->name('users');
Route::get('/admin/users/create', [UserController::class, 'createUser'])->middleware(['auth'])->name('user.create');
Route::post('/admin/users/store', [UserController::class, 'storeUser'])->middleware(['auth'])->name('user.store');
Route::get('/admin/users/edit/{uid}', [UserController::class, 'editUser'])->middleware(['auth'])->name('user.edit');
Route::post('/admin/users/update', [UserController::class, 'updateUser'])->middleware(['auth'])->name('user.update');
Route::get('/admin/users/delete/{uid}', [UserController::class, 'deleteUser'])->middleware(['auth'])->name('user.delete');

//category Routes
Route::get('/admin/categories',[CategoryController::class,'listCategory'])->middleware(['auth'])->name('categories');
Route::get('/admin/categories/create',[CategoryController::class,'createCategory'])->middleware((['auth']))->name('categories.create');
Route::post('/admin/categories/store',[CategoryController::class,'storeCategory'])->middleware(['auth'])->name('categories.store');
Route::get('/admin/categories/edit/{cid}',[CategoryController::class,'editCategory'])->middleware(['auth'])->name('categories.edit');
Route::post('/admin/categories/update',[CategoryController::class,'updateCategory'])->middleware(['auth'])->name('categories.update');
Route::get('/admin/categories/delete/{cid}',[CategoryController::class,'deletecategory'])->middleware(['auth'])->name('categories.delete');

//Sub_categories
Route::get('/admin/sub_categories',[SubCategoryController::class,'listSub_Category'])->middleware(['auth'])->name('sub_categories');
Route::get('/admin/sub_categories/create',[SubCategoryController::class,'createSub_Category'])->middleware((['auth']))->name('sub_categories.create');
Route::post('/admin/sub_categories/store',[SubCategoryController::class,'storeSub_Category'])->middleware((['auth']))->name('sub_categories.store');
Route::get('/admin/sub_categories/edit/{scid}',[SubCategoryController::class,'editSub_Category'])->middleware((['auth']))->name('sub_categories.edit');
Route::post('/admin/sub_categories/update',[SubCategoryController::class,'updateSub_Category'])->middleware((['auth']))->name('sub_categories.update');
Route::get('/admin/sub_categories/delete/{scid}',[SubCategoryController::class,'deleteSub_Category'])->middleware((['auth']))->name('sub_categories.delete');

// Brands Routes
Route::get('/admin/brands',[BrandController::class,'index'])->middleware(['auth'])->name('brands');
Route::get('/admin/brands/create',[BrandController::class,'create'])->middleware((['auth']))->name('brands.create');
Route::post('/admin/brands/store',[BrandController::class,'store'])->middleware((['auth']))->name('brands.store');
Route::get('/admin/brands/edit/{bid}',[BrandController::class,'edit'])->middleware((['auth']))->name('brands.edit');
Route::post('/admin/brands/update',[BrandController::class,'update'])->middleware((['auth']))->name('brands.update');
Route::get('/admin/brands/delete/{bid}',[BrandController::class,'delete'])->middleware((['auth']))->name('brands.delete');


require __DIR__.'/auth.php';

