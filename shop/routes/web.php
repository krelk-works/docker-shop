<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShoeController;

Route::get('/altaCategoria', [CategoryController::class, 'create'])->name('altaCategoria');

Route::get('/altaCalzado', [ShoeController::class, 'create'])->name('altaCalzado');

Route::get('/', function () {
    return view('home');
});

Route::get('/loginPrueba', function () {
    return view('loginPrueba');
});

Route::get('/navbar', function () {
    return view('navbar');
});
Route::resource('shoes', ShoeController::class);


Route::get('/shoes/{id}', [ShoeController::class, 'show'])->name('shoes.show');
Route::post('/shoes/{id}/deactivate', [ShoeController::class, 'deactivate'])->name('shoes.deactivate');
Route::get('/shoes/{id}/edit', [ShoeController::class, 'edit'])->name('shoes.edit');
Route::post('/shoes/{id}/add-size', [ShoeController::class, 'addSize'])->name('shoes.addSize');



Route::resources([
    'category' => CategoryController::class,
    'shoe' => ShoeController::class,
]);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
