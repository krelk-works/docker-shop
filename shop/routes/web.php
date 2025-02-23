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

Route::get('/shoes', [ShoeController::class, 'index'])->name('shoes.index');
Route::get('/categorias', [CategoryController::class, 'index'])->name('category.index');
Route::get('/pedidos', [OrderController::class, 'index'])->name('pedido.index');
Route::get('/shoes', [ShoeController::class, 'index'])->name('shoes.index');
Route::get('/administration', [AdministrationController::class, 'index'])->name('administration');
Route::get('/administration/login', [AdministrationController::class, 'login'])->name('administration.login');
Route::get('/login', [HomeController::class, 'login'])->name('home.login');


Route::resources([
    'category' => CategoryController::class,
    'shoe' => ShoeController::class,
]);

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
