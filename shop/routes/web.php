<?php

use Illuminate\Support\Facades\Route;

//incluir controlador
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return view('welcome');
});

Route::resources([
    'categoria'=> CategoriaController::class
]);


