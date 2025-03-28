<?php
use App\Http\Controllers\InvoiceController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MerchandisingController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ShoeModelController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\GameController;


Route::get('/category/create', [CategoryController::class, 'create'])->name('altaCategoria');

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

//pdf
Route::get('/invoice/{order_id}', [InvoiceController::class, 'generateInvoice'])->name('invoice.download');


//merchandising
Route::get('/merchandising', function () {
    return view('merchandising.merchandising'); // Coincide con la ubicación de la vista
});
Route::post('/merchandising', [MerchandisingController::class, 'store'])->name('merchandising.store');
Route::get('/merchandising', [MerchandisingController::class, 'index'])->name('merchandising.index');

//drag and drop
Route::post('/game', [GameController::class, 'store'])->name('game.store');
Route::get('/game', [GameController::class, 'index'])->name('game.index');

//grafico stock
Route::get('/api/stock-chart', [ShoeController::class, 'stockChart']);

//grafico top products
//Route::get('/top-selling-chart', [ChartController::class, 'topSellingChart']);

Route::get('/top-selling-shoes', [ShoeController::class, 'topSellingShoes']);


//grafico
Route::get('/chart', function () {
    return view('charts');
})->name('charts.view');
Route::get('/charts-data', [ChartController::class, 'getChartData']);

// Route::get('/shoes/{id}', [ShoeController::class, 'show'])->name('shoes.show');
// Route::post('/shoes/{id}/deactivate', [ShoeController::class, 'deactivate'])->name('shoes.deactivate');
// Route::get('/shoes/{id}/edit', [ShoeController::class, 'edit'])->name('shoes.edit');
// Route::post('/shoes/{id}/add-size', [ShoeController::class, 'addSize'])->name('shoes.addSize');
// Route::post('/shoes/{id}/toggle', [ShoeController::class, 'toggleStatus'])->name('shoes.toggle');
// Route::put('/shoe/{id}', [ShoeController::class, 'update'])->name('shoe.update');

// Public shoes routes
Route::get('/shoes/preview/{shoe}', [ShoeController::class, 'preview'])->name('shoes.preview');
Route::post('/shoes/search', [ShoeController::class, 'search'])->name('shoes.search');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/search', [OrderController::class, 'search'])->name('orders.search');

Route::get('/shoes', [ShoeController::class, 'index'])->name('shoes.index');
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/pedidos', [OrderController::class, 'index'])->name('pedido.index');
// Route::get('/shoes', [ShoeController::class, 'index'])->name('shoes.index');
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


// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::post('/cart/import', [CartController::class, 'importLocalCart'])->name('cart.import');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::get('/payment/success', [CartController::class, 'success'])->name('payment.success');



# Favoritos
Route::get('/favorites', function () {
    return view('favorites.index');
})->name('favorites');

# Chart de ejemplo
Route::get('/chart', function () {
    return view('administration.chart');
})->name('chart');

Route::resources([
    'category' => CategoryController::class,
    'shoes' => ShoeController::class,
    'order' => OrderController::class,
    'brands' => BrandController::class,
    'sizes' => SizeController::class,
]);

Route::resource('colors', ColorController::class);


// Definimos así las rutas para evitar conflictos con las rutas de los recursos
Route::get('/_models', [ShoeModelController::class, 'index'])->name('models.index');
Route::get('/_models/create', [ShoeModelController::class, 'create'])->name('models.create');
Route::post('/_models', [ShoeModelController::class, 'store'])->name('models.store');
Route::get('/_models/{model}/edit', [ShoeModelController::class, 'edit'])->name('models.edit');
Route::put('/_models/{model}', [ShoeModelController::class, 'update'])->name('models.update');
Route::delete('/_models/{model}', [ShoeModelController::class, 'destroy'])->name('models.destroy');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
