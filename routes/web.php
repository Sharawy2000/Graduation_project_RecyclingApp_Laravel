<?php

use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\ٍReviewController;
use Laravel\Socialite\Facades\Socialite;


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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('test.login');
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

// routes/web.php





Route::get('/index',function(){
    return view('index');
});
// Route::get('/profile', function () {
//     return view('test.reset');
// })->middleware("auth");


Route::group([
    'prefix'=>'login',
    'controller'=>SocialController::class
],function(){

    Route::get('/facebook', "redirect_facebook");
    Route::get('/facebook/callback', 'callback_facebook');

    Route::get('/google', "redirect_google");
    Route::get('/google/callback',"callback_google");


});




