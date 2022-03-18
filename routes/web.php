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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get("/user", [UserController::class, "index"]);

Route::get('/home',[UserController::class,'redirect']);

Route::post("/create-personne", [PersonneController::class, "addOrder"])->name("create-order");

Route::post("/addOrder", [orderController::class, "addOrder"])->name("create-order");

Route::get("/registration", [CustomAuthController::class, "registration"]);
Route::get("/login", [CustomAuthController::class, "login"]);

Route::post("/register-user", [CustomAuthController::class, "registerUser"])->name("register-user");
Route::post("/login-user", [CustomAuthController::class, "loginUser"])->name("login-user");