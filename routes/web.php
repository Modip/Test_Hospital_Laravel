<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomAuthController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth/login');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get("/user", [UserController::class, "index"])->name('index');
Route::get("/manager", [UserController::class, "homeManager"])->name("homeManager");
Route::get("/admin", [UserController::class, "homeAdmin"])->name("homeAdmin");
Route::get("/admin/edit-order/{id}", [UserController::class, "editOrder"])->name("order.edit");

Route::get("/manager/edit-order/{id}", [UserController::class, "managerEditOrder"])->name("order.edit");



Route::post("/create-order", [OrderController::class, "addOrder"])->name("create-order");
Route::get("/edit-order/{id}", [OrderController::class, "editOrder"])->name("order.edit");
Route::get("/order/{id}", [OrderController::class, "update"])->name("update.order");
Route::post("/update-order", [OrderController::class, "updateOrder"])->name("update-order");

Route::get("/delete-order/{id}", [OrderController::class, "deleteOrder"])->name("delete.order");






Route::get("/registration", [CustomAuthController::class, "registration"]);
Route::get("/login", [CustomAuthController::class, "login"]);

Route::post("/register-user", [CustomAuthController::class, "registerUser"])->name("register-user");
Route::post("/login-user", [CustomAuthController::class, "loginUser"])->name("login-user");