<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/register/store', [\App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register.store');
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login/store', [\App\Http\Controllers\Auth\LoginController::class, 'store'])->name('login.store');
Route::get('/logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
   Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
   Route::resource('products', \App\Http\Controllers\Admin\ProductsController::class);
   Route::resource('categories', \App\Http\Controllers\Admin\CategoriesController::class);
   Route::resource('users', \App\Http\Controllers\Admin\UsersController::class);
   Route::resource('banners', \App\Http\Controllers\Admin\BannersController::class);
   Route::post('/change-role', [\App\Http\Controllers\Admin\UsersController::class, 'changeRole'])->name('users.change-role');
   Route::post('/update-password', [\App\Http\Controllers\Admin\UsersController::class, 'updatePassword'])->name('users.update.password');

   Route::post('/sort-product-images', [\App\Http\Controllers\Admin\ProductPhotosController::class, 'sortPhoto'])->name('sort.photo');
   Route::post('/delete-image', [\App\Http\Controllers\Admin\ProductPhotosController::class, 'delete'])->name('delete.photo');
   Route::post('/upload-image', [\App\Http\Controllers\Admin\ProductPhotosController::class, 'uploadPhotos'])->name('upload.photo');
});
