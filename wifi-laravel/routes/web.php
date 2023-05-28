<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProductsController;
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

Route::get('/', [HomePageController::class, 'index'])->name('home-page');

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductsController::class, 'index'])->name('index');
    Route::get('/create', [ProductsController::class, 'create'])->name('create');
    Route::post('/create', [ProductsController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('edit');
    Route::post('/update', [ProductsController::class, 'update'])->name('update');
//    Route::get('/delete/{id}', [ProductsController::class, 'destroy'])->name('delete');
    Route::post('/delete', [ProductsController::class, 'destroy'])->name('delete');
});
