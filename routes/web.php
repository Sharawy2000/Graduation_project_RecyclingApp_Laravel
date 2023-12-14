<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/register',function(){
//     return view('test.register');
// });
// Route::get('/login',function(){
//     return view('test.login');
// });
// Route::get('/home',function(){
//     return view('welcome');
// })->name('home');


Route::get('/reset',function(){
    return view('test.reset');
});
// Route::get('/profile', function () {
//     return view('test.reset');
// })->middleware("auth");


