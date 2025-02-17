<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShoeController;

Route::get('/altaCategoria', [CategoryController::class, 'create'])->name('altaCategoria');

Route::get('/altaCalzado', [ShoeController::class, 'create'])->name('altaCalzado');

Route::get('/', function () {
    return view('home');
});

Route::resources([
    'category' => CategoryController::class,
    'shoe' => ShoeController::class,
]);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
