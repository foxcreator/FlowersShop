<?php

use Illuminate\Support\Facades\Route;

Route::get('/locale/{locale}', \App\Http\Controllers\LocaleController::class)->name('locale');

Route::middleware(['set_locale'])->group(function () {
	Route::get('/', [\App\Http\Controllers\Front\PagesController::class, 'index'])->name('home');
	Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
	Route::post('/register/store', [\App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register.store');
	Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
	Route::post('/login/store', [\App\Http\Controllers\Auth\LoginController::class, 'store'])->name('login.store');
	Route::get('/logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');
	Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\Auth\EmailVerifyController::class, 'verificationEmailLink'])
		->middleware(['auth', 'signed'])->name('verification.verify');

	Route::name('front.')->group(function () {
		Route::get('/catalog', [\App\Http\Controllers\Front\PagesController::class, 'catalog'])->name('catalog');
		Route::get('/delivery', [\App\Http\Controllers\Front\PagesController::class, 'delivery'])->name('delivery');
		Route::get('/about', [\App\Http\Controllers\Front\PagesController::class, 'about'])->name('about');
		Route::get('/contacts', [\App\Http\Controllers\Front\PagesController::class, 'contacts'])->name('contacts');
		Route::get('/product/{id}', [\App\Http\Controllers\Front\PagesController::class, 'productShow'])->name('product');
		Route::post('/comments/create', [\App\Http\Controllers\Front\CommentsController::class, 'store'])->name('comments.store');
		Route::get('/search', [\App\Http\Controllers\Front\SearchController::class, 'search'])->name('search');

	});
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
   Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
   Route::resource('products', \App\Http\Controllers\Admin\ProductsController::class);
   Route::resource('categories', \App\Http\Controllers\Admin\CategoriesController::class);
   Route::resource('flowers', \App\Http\Controllers\Admin\FlowersController::class);
   Route::resource('subjects', \App\Http\Controllers\Admin\SubjectsController::class);
   Route::resource('users', \App\Http\Controllers\Admin\UsersController::class);
   Route::resource('banners', \App\Http\Controllers\Admin\BannersController::class);
   Route::resource('orders', \App\Http\Controllers\Admin\OrdersController::class);
   Route::post('/change-order-status/{id}', [\App\Http\Controllers\Admin\OrdersController::class, 'changeStatus'])->name('orders.update.status');
   Route::post('/change-role', [\App\Http\Controllers\Admin\UsersController::class, 'changeRole'])->name('users.change-role');
   Route::post('/update-password', [\App\Http\Controllers\Admin\UsersController::class, 'updatePassword'])->name('users.update.password');

    Route::get('/fetch-product-data', [\App\Http\Controllers\Admin\ProductsController::class, 'fetchData'])->name('products.fetch');
   Route::post('/sort-product-images', [\App\Http\Controllers\Admin\ProductPhotosController::class, 'sortPhoto'])->name('sort.photo');
   Route::post('/delete-image', [\App\Http\Controllers\Admin\ProductPhotosController::class, 'delete'])->name('delete.photo');
   Route::post('/upload-image', [\App\Http\Controllers\Admin\ProductPhotosController::class, 'uploadPhotos'])->name('upload.photo');
});
