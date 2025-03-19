<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

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

//USER CONTROLLER
Route::get('/register', [UserController::class, 'register']);
Route::POST('/register-user', [UserController::class, 'createUser']);
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::POST('/login', [UserController::class, 'authenticate']);

Route::middleware('auth')->group(function() {
    Route::get('/items', [ItemController::class, 'viewItem'])->name('view');
    Route::POST('/logout', [UserController::class, 'logout']);

    Route::POST('/cart/add/{id}', [CartController::class, 'cartStore'])->name('cart.add');

    Route::get('/cart', [CartController::class, 'getCart'])->name('getCart');
    // Route::POST('/add-to-cart', [CartController::class, 'cartStore'])->name('cartStore');
    Route::DELETE('/remove-cart-item', [CartController::class, 'removeItem'])->name('removeItem');
});

Route::middleware('admin')->group(function(){

    Route::get('/create',  [ItemController::class, 'createPage'])->name('create');

    Route::POST('/create-item', [ItemController::class, 'createItem']);

    Route::get('/update/{item}', [ItemController::class, 'getItemById'])->name('updateItemPage');

    Route::put('/items/{item}', [ItemController::class, 'updateItem'])->name('items.update');

    // Route::patch('/update/{item}', [ItemController::class, 'updateItem'])->name('updateItem');
    // Route::put('/update/{item}', [ItemController::class, 'updateItem'])->name('items.update');
    // Route::put('/item/{item}', [ItemController::class, 'updateItem'])->name('updateItem');
    // Route::put('/items/{id}', [ItemController::class, 'updateItem'])->name('items.update');

    

    Route::delete('/item/{item}', [ItemController::class, 'deleteItem'])->name('deleteItem');

    Route::get('/createCategory', [CategoryController::class, 'createCategoryPage']);

    Route::POST('/create-Category', [CategoryController::class, 'createCategory']);
});
