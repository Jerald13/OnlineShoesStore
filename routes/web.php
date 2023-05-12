<?php

use App\Http\Controllers\FreeGiftController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, 'store'])->name('index');

Route::get('/adminIndex', [UserController::class, 'userList'])->name('adminIndex');

Route::get('/usernameLogin', [UserController::class, 'usernameLoginForm'])->name('usernamelogin');
Route::get('/emailLogin', [UserController::class, 'emailLoginForm'])->name('emaillogin');
Route::get('/adminLogin', [UserController::class, 'adminLoginForm'])->name('adminlogin');
Route::get('/register', [UserController::class, 'registerForm'])->name('registerForm');

Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/editUserForm/{id}', [UserController::class, 'editUserForm'])->name('editUserForm');
Route::post('/editUser', [UserController::class, 'editUserProfile'])->name('editUser');
Route::get('/importUserForm',[UserController::class, 'importUserForm'])->name('importUserForm');
Route::post('/displayImportedUser', [UserController::class, 'displayImportedUser'])->name('displayImportedUser');
Route::post('/importUser', [UserController::class, 'importUser'])->name('importUser');

Route::get('/productslist', [ProductController::class, 'productList'])->name('productList');
Route::get('/createProductForm', [ProductController::class, 'createProductForm'])->name('createProductForm');
Route::get('/importProductForm', [ProductController::class, 'importProductForm'])->name('importproduct');
Route::get('/editProductForm/{id}', [ProductController::class, 'editProductForm'])->name('editProductForm');
Route::post('/createproduct', [ProductController::class, 'createProduct'])->name('createProduct');
Route::post('/editproduct', [ProductController::class, 'editProduct'])->name('editProduct');
Route::post('/displayImportedProduct', [ProductController::class, 'displayImportedProduct'])->name('displayImportedProduct');
Route::post('/importProduct', [ProductController::class, 'importProduct'])->name('importProduct');

Route::get('/orderlist', [OrderController::class, 'orderList'])->name('orderList');
Route::get('/completeOrder/{id}',[OrderController::class, 'completeOrder'])->name('completeOrder');
Route::post('/buy',[OrderController::class, 'buyProduct'])->name('buyProduct');
Route::get('/checkout/{id}',[OrderController::class, 'checkout'])->name('checkout');
Route::get("/orders", [OrderController::class, 'orders'])->name('orders');

Route::get('/getFreeGift', [FreeGiftController::class, 'freeGiftForm'])->name('getFreeGift');
Route::get('/redeem/{point}/{id}', [FreeGiftController::class, 'redeem'])->name('redeem');

Route::view("page-404", "page-404")->name("page-404");
