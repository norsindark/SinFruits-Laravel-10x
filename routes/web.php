<?php

use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\WarehouseController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProductCrawlerController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\client\ProductsController;
use App\Http\Controllers\Client\CategoriesController;
use App\Http\Controllers\Client\CartsController;
use App\Http\Controllers\Client\CheckoutsController;
use App\Http\Controllers\Client\OrdersController;
use App\Http\Controllers\Client\UsersController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\ReportController;

// Crawl Products
Route::middleware(['auth', 'verified', 'role:1'])->group(function () {
    Route::get('/crawl', [ProductCrawlerController::class, 'crawl'])->name('crawl');
});


// Crawl Product Details
Route::middleware(['auth', 'verified', 'role:1'])->group(function () {
    Route::get('/crawl-details', [ProductCrawlerController::class, 'crawlDetail'])->name('crawlDetail');
});


// Dashboard
Route::prefix('/dashboard')->middleware(['auth', 'verified', 'role:1'])->group(function () {

    // author
    Route::get('/', function () {
        if (auth()->check() && auth()->user()->role == 1) {
            return view('dashboard.pages.dashboard');
        } else {
            abort(404, 'ERROR');
        }
    })->name('dashboard');

    // categories
    Route::prefix('/categories')->group(function () {

        Route::get('/', [CategoryController::class, 'index'])->name('dashboard.categories.index');
        Route::get('/create', function () {
            return view('dashboard.pages.categories.create');
        })->name('dashboard.categories.create');
        Route::post('/', [CategoryController::class, 'store'])->name('dashboard.categories.store');
        Route::get('/{category_slug}', [CategoryController::class, 'showByCategory'])->name('dashboard.categories.showByCategory');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('dashboard.categories.edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('dashboard.categories.update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('dashboard.categories.destroy');
    });

    // warehouses
    Route::prefix('/warehouses')->group(function () {
        Route::get('/', [WarehouseController::class, 'index'])->name('dashboard.warehouses.index');
        Route::get('/create', [WarehouseController::class, 'create'])->name('dashboard.warehouses.create');
        Route::post('/', [WarehouseController::class, 'store'])->name('dashboard.warehouses.store');
        Route::get('/{warehouse}', [WarehouseController::class, 'show'])->name('dashboard.warehouses.show');
        Route::get('/{warehouse}/edit', [WarehouseController::class, 'edit'])->name('dashboard.warehouses.edit');
        Route::put('/{warehouse}', [WarehouseController::class, 'update'])->name('dashboard.warehouses.update');
        Route::delete('/{warehouse}', [WarehouseController::class, 'destroy'])->name('dashboard.warehouses.destroy');
        Route::get('/{warehouse}/products', [WarehouseController::class, 'showProducts'])->name('dashboard.warehouses.showProducts');

        // Route::get('/{warehouse}/edit', [WarehouseController::class, 'updateQuantity'])->name('dashboard.warehouses.updateQuantity');
    });

    // products
    Route::prefix('/products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('dashboard.products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('dashboard.products.create');
        Route::post('/', [ProductController::class, 'store'])->name('dashboard.products.store');
        Route::get('/{product}', [ProductController::class, 'show'])->name('dashboard.products.show');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('dashboard.products.edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('dashboard.products.update');
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('dashboard.products.destroy');
    });

    // users
    Route::prefix('/users')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('dashboard.users.index');
        Route::get('/create', [UserController::class, 'create'])->name('dashboard.users.create');
        Route::post('/store', [UserController::class, 'store'])->name('dashboard.users.store');
        Route::get('/{user}', [UserController::class, 'show'])->name('dashboard.users.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('dashboard.users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('dashboard.users.update');
        Route::put('/{user}/ban', [UserController::class, 'banUser'])->name('dashboard.users.ban');
        Route::delete('/{id}/delete-image', [UserController::class, 'deleteImage'])->name('dashboard.users.deleteImage');
    });

    // orders
    Route::prefix('/orders')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('dashboard.orders.index');
    });

    // report
    Route::prefix('/reports')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('dashboard.reports.index');
    });
});


//Client
Route::prefix('/')->group(function () {
    Route::get('/', function () {
        return view('client.home.index');
    });

    // categories
    Route::prefix('/categories')->group(function () {
        Route::get('/', [CategoriesController::class, 'index'])->name('client.categories.index');
        // Route::get('/{category}', [CategoriesController::class, 'show'])->name('client.categories.show');
        Route::get('/{category_slug}', [CategoriesController::class, 'showByCategory'])->name('client.products.showByCategory');
    });


    // products
    Route::prefix('/product')->group(function () {

        Route::get('/details/{title}', [ProductsController::class, 'showDetails'])->name('client.product.details');

        Route::post('/cart/add', [CartsController::class, 'addToCart'])->middleware(['auth', 'verified'])->name('client.cart.add');
        Route::get('/search', [ProductsController::class, 'search'])->name('client.products.search');
        Route::get('/sorted', [ProductsController::class, 'sortProducts'])->name('client.products.sorted');
    });


    // carts
    Route::prefix('/cart')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [CartsController::class, 'index'])->name('client.cart.index');
        Route::post('/remove', [CartsController::class, 'remove'])->name('client.cart.remove');
        Route::put('/update-quantity/{productId}', [CartsController::class, 'updateQuantity'])->name('client.cart.updateQuantity');
    });


    // check out
    Route::prefix('/checkout')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [CheckoutsController::class, 'index'])->name('client.checkout.index');
    });


    // orders
    Route::prefix('/order')->middleware(['auth', 'verified'])->group(function () {
        Route::post('/create-order', [OrdersController::class, 'create'])->name('client.create.order');
        Route::post('/cancel', [OrdersController::class, 'cancelOrder'])->name('client.order.cancel');
    });


    // profile
    Route::prefix('/my-account')->middleware(['auth', 'verified'])->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('client.user.index');

        Route::get('/profile', [UsersController::class, 'edit'])->name('client.profile.edit');
        Route::patch('/profile', [UsersController::class, 'update'])->name('client.profile.update');
        Route::put('password', [UsersController::class, 'updatePassword'])->name('client.password.updatePassword');
        Route::put('/update-address', [UsersController::class, 'updateAddress'])->name('client.password.updateAddress');

        // Route::delete('/profile', [UsersController::class, 'destroy'])->name('client.profile.destroy');
    });

    //users
    Route::post('/logout', 'Auth\UsersController@logout')->middleware(['auth'])->name('client.user.logout');
});























// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::patch('/profile/update-image', [ProfileController::class, 'updateImage'])->name('profile.update-image');

//user
// Route::get('/sign-in', [ProfileController::class, 'SignIn'])->name('user.login');
Route::get('/sign-in', function () {
    return view('client.pages.users.sign-in');
})->name('user.login');
Route::get('/sign-up', function () {
    return view('client.pages.users.sign-up');
})->name('user.register');
Route::get('/password-reset', function () {
    return view('client.pages.users.forgot-password');
})->name('user.forgot');









//Verify Email

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

require __DIR__ . '/auth.php';
