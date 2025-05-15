<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomersController;

Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
})->middleware(['auth', 'verified']);
// Admin auth (default Breeze)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    });
});

Route::get('customer/login', [CustomersController::class, 'showLoginForm'])->name('customer.login');
Route::post('customer/login', [CustomersController::class, 'login']);
Route::get('customer/register', [CustomersController::class, 'showRegisterForm'])->name('customer.register');
Route::post('customer/register', [CustomersController::class, 'register']);
Route::post('customer/logout', [CustomersController::class, 'logout'])->name('customer.logout');

Route::middleware('auth:customer')->group(function () {
    Route::get('/customer/dashboard', function () {
        return view('customer.dashboard');
    });
});

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('products', ProductController::class);
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
// Route::get('/product', [ProductController::class, 'index'])->name('products.index');
// Route::get('/product/create', [ProductController::class, 'create'])->name('products.create');
// Route::get('product/{slug}', [HomepageController::class, 'product']);
Route::get('categories', [HomepageController::class, 'categories']);
Route::get('category/{slug}', [HomepageController::class, 'category']);
Route::get('cart', [HomepageController::class, 'cart']);
Route::get('checkout', [HomepageController::class, 'checkout']);
Route::resource('categories', ProductCategoryController::class);
Route::delete('/categories/{id}', [ProductCategoryController::class, 'destroy'])->name('categories.destroy');


// Route::get('/', function(){ 
//    $title = "Homepage"; 

//    return view('web.homepage',['title'=>$title]); 
// }); 

// Route::get('product', function(){ 
//    $title = "Product"; 

//    return view('web.product',['title'=>$title]); 
// }); 

// Route::get('product/{slug}', function($slug){ 
//    $title = "Single Product"; 

//    return view('web.single_product',['title'=>$title,'slug'=>$slug]); 
// }); 

// Route::get('categories', function(){ 
//    $title = "Categories"; 

//    return view('web.categories',['title'=>$title]); 
// }); 

// Route::get('categories/{slug}', function($slug){ 
//    $title = "Single Categories"; 

//    return view('web.single_categories',['title'=>$title,'slug'=>$slug]); 
// }); 

// Route::get('cart', function(){ 
//    $title = "Cart"; 

//    return view('web.cart',['title'=>$title]); 
// }); 

// Route::get('checkout', function(){ 
//    $title = "Checkout"; 

//    return view('web.checkout',['title'=>$title]); 
// }); 

// Route::get('/', function () {
//     return view('web.homepage');
// });

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::group(['prefix' => 'dashboard'], function () {

    Route::resource('categories', ProductCategoryController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
