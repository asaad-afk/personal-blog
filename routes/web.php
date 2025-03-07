<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function(){
    Route::get('/', [BlogController::class, 'index'])->name('home');
    Route::post('posts/ajax-like-dislike', [blogController::class, 'ajaxLike'])->name('posts.ajax.like.dislike');
    Route::delete("/logout",[AuthController::class,"logout"])->name("logout");

});



Route::get("/login",[AuthController::class,"login"])->name("login");
Route::post("/login",[AuthController::class,"loginPost"])->name("loginPost");
Route::GET("/register",[AuthController::class,"register"])->name("register");
Route::post("/register",[AuthController::class,"registerPost"])->name("registerPost");





