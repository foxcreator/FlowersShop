<?php

use App\Http\Controllers\Auth\UpdatePasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/locale/{locale}', \App\Http\Controllers\LocaleController::class)->name('locale');
Route::get('/test', function () {
    $order = \App\Models\Order::find(27);
    return view('mails.order-success', compact('order'));
});
Route::middleware(['set_locale'])->group(function () {
	Route::get('/', [\App\Http\Controllers\Front\PagesController::class, 'index'])->name('home');

    Route::middleware(['guest'])->group(function () {
        Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
        Route::post('/register/store', [\App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register.store');
        Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
        Route::post('/login/store', [\App\Http\Controllers\Auth\LoginController::class, 'store'])->name('login.store');
        Route::post('forgot-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'store'])
            ->name('password.email');
        Route::get('/reset-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'create'])
            ->name('password.reset');
        Route::post('/update-password', [UpdatePasswordController::class, 'store']);
    });
    Route::get('/logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout')->middleware(['auth']);


    Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\Auth\EmailVerifyController::class, 'verificationEmailLink'])

		->middleware(['auth', 'signed'])->name('verification.verify');

    Route::name('front.')->group(function () {
		Route::get('/catalog', [\App\Http\Controllers\Front\PagesController::class, 'catalog'])->name('catalog');
		Route::get('/delivery', [\App\Http\Controllers\Front\PagesController::class, 'delivery'])->name('delivery');
		Route::get('/about', [\App\Http\Controllers\Front\PagesController::class, 'about'])->name('about');
		Route::get('/contacts', [\App\Http\Controllers\Front\PagesController::class, 'contacts'])->name('contacts');
		Route::get('/product/{id}', [\App\Http\Controllers\Front\PagesController::class, 'productShow'])->name('product');
		Route::post('/change-flowers', [\App\Http\Controllers\Front\PagesController::class, 'changeFlowerForm'])->name('change.flower');
		Route::get('/purchase/order-page', [\App\Http\Controllers\OrderController::class, 'index'])->name('orderPage');
		Route::post('/purchase/order-store', [\App\Http\Controllers\OrderController::class, 'store'])->name('order.store');
		Route::get('/purchase/order-success', [\App\Http\Controllers\OrderController::class, 'orderSuccess'])->name('order.success');
		Route::post('/comments/create', [\App\Http\Controllers\Front\CommentsController::class, 'store'])->name('comments.store');
		Route::get('/search', [\App\Http\Controllers\Front\SearchController::class, 'search'])->name('search');
        Route::get('/purchase/cart', [\App\Http\Controllers\Front\CartController::class, 'index'])->name('cart');
        Route::post('/add-to-cart', [\App\Http\Controllers\Front\CartController::class, 'addToCart'])->name('addToCart');
        Route::post('/remove-from-cart/{id}', [\App\Http\Controllers\Front\CartController::class, 'removeItem'])->name('removeItem');
        Route::post('/update-cart-quantity', [\App\Http\Controllers\Front\CartController::class, 'updateQuantity'])->name('updateQuantity');
        Route::post('/toggle-favorite', [\App\Http\Controllers\Front\FavoriteProductController::class, 'toggleFavorite']);
        Route::get('/favorites', [\App\Http\Controllers\Front\FavoriteProductController::class, 'index'])->name('favorites')->middleware('auth');
        Route::post('/save-city', [\App\Http\Controllers\Front\UserController::class, 'saveCity'])->name('save-city');

        Route::get('/user/profile', [\App\Http\Controllers\Front\UserController::class, 'index'])->name('user.profile')->middleware('auth');
        Route::post('/user/update-profile/{id}', [\App\Http\Controllers\Front\UserController::class, 'update'])->name('update.profile')->middleware('auth');
        Route::post('/bonus-pay', [\App\Http\Controllers\OrderController::class, 'payWithBonuses'])->name('order.bonus')->middleware('auth');

        Route::post('/feedback/store', [\App\Http\Controllers\FeedbackController::class, 'store'])->name('feedback');

	});
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
   Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/categories/{id}/subcategories', [\App\Http\Controllers\Admin\CategoriesController::class, 'getSubcategories']);
    Route::get('products/sort-novelty', [\App\Http\Controllers\Admin\ProductsController::class, 'sortNovelty'])->name('products.sort-novelty');
    Route::post('products/sort-novelty-update', [\App\Http\Controllers\Admin\ProductsController::class, 'sortNoveltyUpdate'])->name('products.sort-novelty.update');
    Route::resource('products', \App\Http\Controllers\Admin\ProductsController::class);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoriesController::class);
    Route::resource('flowers', \App\Http\Controllers\Admin\FlowersController::class);
    Route::resource('subjects', \App\Http\Controllers\Admin\SubjectsController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UsersController::class);
    Route::resource('banners', \App\Http\Controllers\Admin\BannersController::class);
    Route::resource('orders', \App\Http\Controllers\Admin\OrdersController::class);
    Route::resource('subcategories', \App\Http\Controllers\Admin\SubcategoriesController::class);
    Route::post('/change-order-status/{id}', [\App\Http\Controllers\Admin\OrdersController::class, 'changeStatus'])->name('orders.update.status');
   Route::post('/change-role', [\App\Http\Controllers\Admin\UsersController::class, 'changeRole'])->name('users.change-role');
   Route::post('/update-password', [\App\Http\Controllers\Admin\UsersController::class, 'updatePassword'])->name('users.update.password');

   Route::post('/sort-product-images', [\App\Http\Controllers\Admin\ProductPhotosController::class, 'sortPhoto'])->name('sort.photo');
   Route::post('/delete-image', [\App\Http\Controllers\Admin\ProductPhotosController::class, 'delete'])->name('delete.photo');
   Route::post('/upload-image', [\App\Http\Controllers\Admin\ProductPhotosController::class, 'uploadPhotos'])->name('upload.photo');
});
