<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\CheckAge;
use App\Http\Middleware\CheckUserCreated;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->middleware([CheckAge::class])->name('main_page');
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'registration'])->name('registration');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'checklogin'])->name('checklogin');
Route::get('/catalog/{category}/{product}', [CatalogController::class, 'product'])->name('product');
Route::get('/catalog/{category}', [CatalogController::class, 'category'])->name('catalog_category');
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/random-product', [ProductController::class, 'random'])->middleware([CheckUserCreated::class])->name('random_product');


Route::prefix('adm')->name('admin.')->middleware([CheckAge::class])->group(function (){
    Route::view('/', 'admin.dashboard')->name('dashboard');
    Route::resources([
        'categories' => CategoryController::class,
        'products' => ProductController::class
    ]);
});


