<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

Route::get('/altaCategoria', [CategoryController::class, 'create'])->name('altaCategoria');

Route::get('/altaCalzado', [ShoeController::class, 'create'])->name('altaCalzado');

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/loginPrueba', function () {
    return view('loginPrueba');
});

Route::get('/navbar', function () {
    return view('navbar');
});

// Route::get('/home', function () {
//     return view('home');
// });

Route::resource('shoes', ShoeController::class);


Route::get('/shoes/{id}', [ShoeController::class, 'show'])->name('shoes.show');
Route::post('/shoes/{id}/deactivate', [ShoeController::class, 'deactivate'])->name('shoes.deactivate');
Route::get('/shoes/{id}/edit', [ShoeController::class, 'edit'])->name('shoes.edit');
Route::post('/shoes/{id}/add-size', [ShoeController::class, 'addSize'])->name('shoes.addSize');
Route::post('/shoes/{id}/toggle', [ShoeController::class, 'toggleStatus'])->name('shoes.toggle');
Route::put('/shoe/{id}', [ShoeController::class, 'update'])->name('shoe.update');

// Public shoes routes
Route::get('/shoes/preview/{id}', [ShoeController::class, 'preview'])->name('shoes.preview');
Route::post('/shoes/search', [ShoeController::class, 'search'])->name('shoes.search');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/search', [OrderController::class, 'search'])->name('orders.search');

Route::get('/shoes', [ShoeController::class, 'index'])->name('shoes.index');
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/pedidos', [OrderController::class, 'index'])->name('pedido.index');
Route::get('/shoes', [ShoeController::class, 'index'])->name('shoes.index');
Route::get('/administration', [AdministrationController::class, 'index'])->name('administration');
Route::get('/administration', [AdministrationController::class, 'index'])->name('administration.home');
Route::get('/administration/login', [AdministrationController::class, 'login'])->name('administration.login');
Route::get('/login', [HomeController::class, 'login'])->name('home.login');
Route::post('/categories/{id}/toggle', [CategoryController::class, 'toggleStatus'])->name('categories.toggle');
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{id}', [OrderController::class, 'update'])->name('orders.update');



Route::resources([
    'category' => CategoryController::class,
    'shoe' => ShoeController::class,
    'order' => OrderController::class,
]);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
