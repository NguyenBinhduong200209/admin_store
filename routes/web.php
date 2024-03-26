<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;



use App\Http\Controllers\AdminUserController;

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
});

// Auth::routes(['verify' => true]);
Route::get('/dashboard', [DashboardController::class, 'show'])
    ->middleware(['auth'])
    //'verified'
    ->name('dashboard');
Route::middleware(['auth'])->group(function () {
    Route::get('admin', [DashboardController::class, 'show']);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/admin/user/list', [AdminUserController::class, 'list']);
    Route::get('/admin/user/add', [AdminUserController::class, 'add']);
    Route::post('/admin/user/add', [AdminUserController::class, 'store']);
    Route::get('/admin/user/delete/{id}', [AdminUserController::class, 'delete'])->name('delete_user');
});
Route::get('/cart', [CartController::class, 'getData']);
Route::post('/add-cart', [CartController::class, 'addCart']);
Route::get('/cart-data', [CartController::class, 'getDataFromTable']);
Route::delete('/cart-data/{id}', [CartController::class, 'deleteCartItem']);
Route::delete('/delete-cart/{id}', [CartController::class, 'delete']);
Route::put('/update-cart/{id_product}', [CartController::class, 'update']);
Route::get('/all-cart/{user_id}', [CartController::class, 'getDataFromTable']);

Route::get('/product', [ProductController::class, 'getData']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::post('/add-product', [ProductController::class, 'add']);
Route::delete('/delete-product/{id}', [ProductController::class, 'delete']);
Route::put('/update-product/{id}', [ProductController::class, 'update']);


require __DIR__ . '/auth.php';
