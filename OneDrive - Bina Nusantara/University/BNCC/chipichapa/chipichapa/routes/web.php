<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main', function () {
    return view('main');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/register', [UserController::class, 'register']);
Route::POST('/register-user', [UserController::class, 'createUser']);
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::POST('/login', [UserController::class, 'authenticate']);

Route::middleware('auth')->group(function() {
    Route::get('/items', [ItemController::class, 'viewItem'])->name('view');
    Route::POST('/logout', [UserController::class, 'logout']);

    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');


    Route::get('/cart', [CartController::class, 'getCart'])->name('getCart');
    Route::get('/invoice', [CartController::class, 'showInvoice'])->name('invoice.show');
    Route::post('/invoice/submit', [CartController::class, 'submitInvoice'])->name('invoice.submit');

    Route::post('/invoice/submit', [InvoiceController::class, 'store'])->name('invoice.submit');
    Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');

    Route::DELETE('/remove-cart-item', [CartController::class, 'removeItem'])->name('removeItem');

    Route::get('/checkout', [InvoiceController::class, 'show'])->name('invoice.show');
    Route::post('/checkout', [InvoiceController::class, 'processCheckout'])->name('checkout');
    Route::get('/checkout', [InvoiceController::class, 'checkoutPage'])->name('checkout.page');

    Route::get('/catalog', [ItemController::class, 'index'])->name('item.catalog');

});

Route::middleware('admin')->group(function(){
    Route::post('/items/store', [ItemController::class, 'store'])->name('items.store');

    Route::get('/create', [ItemController::class, 'createPage'])->name('create-item');    

    Route::POST('/create-item', [ItemController::class, 'createItem']);

    Route::get('/update/{item}', [ItemController::class, 'getItemById'])->name('updateItemPage');

    Route::put('/items/{item}', [ItemController::class, 'updateItem'])->name('items.update');

    Route::delete('/item/{item}', [ItemController::class, 'deleteItem'])->name('deleteItem');

    Route::get('/createCategory', [CategoryController::class, 'createCategoryPage']);

    Route::POST('/create-Category', [CategoryController::class, 'createCategory']);
});
