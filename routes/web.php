<?php

use App\Http\Controllers\Mycontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\usermiddleware;
// use App\Http\Controllers\Auth_controller;

// Route::get('/', function () {
//     return view('auth.login');
// });
// Route::get('/index',[Mycontroller::class,'index'])->name('candidates.index');
// Route::get('create',[Mycontroller::class,'create'])->name('candidates.create');
// Route::post('candidates/store',[Mycontroller::class,'store'])->name("store");
// Route::get('edit/{id}',[Mycontroller::class,'edit']);
// Route::post('candidates/update',[Mycontroller::class,'update']);
// Route::get('candidates/{id}/delete',[Mycontroller::class,'destroy']);
// Route::get('dependent-dropdown', [MyController::class, 'country']);
// Route::post('api/fetch-states', [MyController::class, 'fetchState']);
// Route::post('api/fetch-cities', [MyController::class, 'fetchCity']);
// Route::get("/login",[Mycontroller::class,"login"])->name("login"); 
// Route::post("/login",[Mycontroller::class,"loginPost"])->name("login.post");
// Route::get("/register",[Mycontroller::class,"register"])->name("register");
// Route::post("/register",[Mycontroller::class,"registerPost"])->name("register.post");
// Route::get("/changepassword",[Mycontroller::class,"changepassword"])->name("changepassword");
// Route::post("/changepassword",[Mycontroller::class,"updatepassword"])->name("updatepassword");
// Route::post('/checkContact', [Mycontroller::class,"checkContact"])->name("checkContact");
// Route::get('logout',[Mycontroller::class,"logout"]);




Route::get("/",[Mycontroller::class,"login"])->name("login"); 
Route::post("/login",[Mycontroller::class,"loginPost"])->name("login.post");

Route::middleware([usermiddleware::class])->group(function () {
Route::get('/index',[Mycontroller::class,'index'])->name('candidates.index');
Route::get('/loginindex',[Mycontroller::class,'loginindex'])->name('loginindex');
Route::get('create',[Mycontroller::class,'create'])->name('candidates.create');
Route::post('candidates/store',[Mycontroller::class,'store'])->name("store");
Route::get('edit/{id}',[Mycontroller::class,'edit']);
Route::post('candidates/update',[Mycontroller::class,'update']);
Route::get('candidates/{id}/delete',[Mycontroller::class,'destroy']);
Route::get('dependent-dropdown', [MyController::class, 'country']);
Route::post('api/fetch-states', [MyController::class, 'fetchState']);
Route::post('api/fetch-cities', [MyController::class, 'fetchCity']);
Route::get('logout',[Mycontroller::class,"logout"]);
});

Route::get("/register",[Mycontroller::class,"register"])->name("register");
Route::post("/register",[Mycontroller::class,"registerPost"])->name("register.post");
Route::get("/changepassword",[Mycontroller::class,"changepassword"])->name("changepassword");
Route::post("/changepassword",[Mycontroller::class,"updatepassword"])->name("updatepassword");
Route::post('/checkContact', [Mycontroller::class,"checkContact"])->name("checkContact");


