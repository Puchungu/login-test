<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;

//login
Route::get('/login', [Login::class, 'showLogin'])->name('login');
Route::post('/login', [Login::class, 'login'])->name('login.post');
Route::post('/login', [Login::class, 'iniciosesion'])->name('sesion.post');
//signup
Route::get('/signup', [Login::class, 'signupreturn'])->name('signup');
Route::post('/signup', [Login::class, 'store'])->name('signup.post');

Route::get('/home', function () {
    return view('Home');
})->name('home');



