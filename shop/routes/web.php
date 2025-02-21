<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShoeController;

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

Route::get('/home2', function () {
    return view('pages.home.home');
});

Route::resource('shoes', ShoeController::class);


Route::get('/shoes/{id}', [ShoeController::class, 'show'])->name('shoes.show');
Route::post('/shoes/{id}/deactivate', [ShoeController::class, 'deactivate'])->name('shoes.deactivate');
Route::get('/shoes/{id}/edit', [ShoeController::class, 'edit'])->name('shoes.edit');
Route::post('/shoes/{id}/add-size', [ShoeController::class, 'addSize'])->name('shoes.addSize');

Route::get('/shoes', [ShoeController::class, 'index'])->name('shoes.index');
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
Route::get('/shoes', [ShoeController::class, 'index'])->name('shoes.index');


Route::resources([
    'category' => CategoryController::class,
    'shoe' => ShoeController::class,
]);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
