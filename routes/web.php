<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductsController;






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

    Route::get('admin/product/list', [ProductsController::class, 'index'])->name('products.index');
    Route::get('admin/product/create', [ProductsController::class, 'create']);
    Route::post('admin/product/store', [ProductsController::class, 'store']);
    Route::get('/admin/product/{id}', [ProductsController::class, 'destroy'])->name('delete_product');
    Route::get('admin/product/edit/{id}', [ProductsController::class, 'edit'])->name('product.edit');
    Route::put('admin/product/update/{id}', [ProductsController::class, 'update'])->name('product.update');
});



require __DIR__ . '/auth.php';
