<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryImages;
use App\Http\Controllers\CategoryImagesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
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
// kashan connected
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'home'])->middleware(['auth'])->name('home');
Route::get('/admin-page', [HomeController::class, 'adminpage'])->middleware(['auth','admin'])->name('admin-page');

//sub category
// Route::get('/add-sub-category', [SubCategoryController::class, 'add_sub_category'])->middleware(['auth','admin'])->name('add-sub-category');
Route::post('/store-sub-category', [SubCategoryController::class, 'store_sub_category'])->name('store-sub-category');
Route::get('/all-sub-category', [SubCategoryController::class, 'all_sub_category'])->middleware(['auth','admin'])->name('all-sub-category');
Route::post('/update-subcategory', [SubCategoryController::class, 'update_subcategory'])->name('update-subcategory');

//category
Route::get('/category', [CategoryController::class, 'category'])->middleware(['auth','admin'])->name('category');
Route::post('/store-category', [CategoryController::class, 'store_category'])->name('store-category');
Route::post('/update-category', [CategoryController::class, 'update_category'])->name('update-category');

// Category Images
Route::get('/category-images', [CategoryImagesController::class, 'category_images'])->middleware(['auth','admin'])->name('category-images');
Route::post('/store-category-images', [CategoryImagesController::class, 'store_category_images'])->name('store-category-images');
Route::get('/get-categories/{subCategory}', [CategoryImagesController::class, 'getCategories']);
Route::get('/get-category', [CategoryImagesController::class, 'get_category'])->name('get-category');
// Route::post('/update-category', [CategoryController::class, 'update_category'])->name('update-category');






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Route::get('/', function () { return view('welcome');});
// Route::get('/login', [LoginController::class, 'login'])->name('login');
// Route::post('/admin-logged', [LoginController::class, 'admin_logged'])->name('admin-logged');
// Route::get('/admin-logout', [LoginController::class, 'admin_logout'])->name('admin-logout');
// Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');


