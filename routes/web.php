<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AdminPanel\UserController;
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


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/onama', [OnamaController::class, 'index'])->name('onama');
Route::get('/kontakt', [KontaktController::class, 'index'])->name('kontakt');
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/lokacije', [LokacijeController::class, 'index'])->name('lokacije');

Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/product/filtered', [ProductController::class, 'getFiltered']);
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');



Route::prefix('admin')->group(function () {
    Route::get('/product/filtered', [AdminPanel\ProductController::class, 'getFiltered']);
    Route::get('/users/filtered', [AdminPanel\UserController::class, 'getFiltered']);
    Route::get('/users/activity/{id}/filtered', [AdminPanel\UserController::class, 'getFilteredActivity']);


    Route::get('/users/{id}/activity', [AdminPanel\UserController::class, 'activity'])->name('users.activity');
    Route::get('/users/activity/{id}', [AdminPanel\UserController::class, 'destroyActivity'])->name('users.destroyActivity');


    Route::resource('/products',  AdminPanel\ProductController::class);
    Route::resource('/users', AdminPanel\UserController::class);
    Route::resource('/statistics', AdminPanel\StatisticsController::class);

});


Route::get('/galerija', [GalerijaController::class, 'index'])->name('galerija');
Route::get("/logout", [OsnovniController::class, 'logout'])->name("logout");
Route::post("/login", [OsnovniController::class, 'login'])->name("login");
Route::post("/register", [OsnovniController::class, 'register'])->name("register");
Route::get("/user", [UserControllers\UserController::class, 'index'])->name("user");
Route::put("/user/{id}/update", [UserControllers\UserController::class, 'update'])->name("user.update");
Route::get("/autor" , [OsnovniController::class, 'autor'])->name("autor");


/*Route::middleware(['loggedIn'])->group(function (){
Route::get();
Route::post('/addtocart/{pId}', [UserController::class,
    'addToCart']);
});*/

//Route::resource("/product", \App\Http\Controllers\ProductController::class);





