<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
Route::get('/story', [App\Http\Controllers\StoryController::class, 'index'])->name('story.index');
Route::get('/story/{id}', [App\Http\Controllers\StoryController::class, 'show'])->name('story.show');
Route::get('/benefits', [App\Http\Controllers\PageController::class, 'benefits'])->name('benefits');
Route::get('/about', [App\Http\Controllers\PageController::class, 'about'])->name('about');

Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin Routes
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
        Route::resource('orders', App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'update']);
        Route::resource('articles', App\Http\Controllers\Admin\ArticleController::class);
        Route::resource('events', App\Http\Controllers\Admin\EventController::class);
    });
});

// Cart Routes
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');

// Checkout Route
Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');

require __DIR__.'/auth.php';
