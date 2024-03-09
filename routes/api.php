<?php

use App\Models\comment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ٍReviewController,
    UserController,
    AdminController,
    PostController,
    SocialController,
    };
    
use App\Http\Controllers\Reset_Password_Api\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('login/facebook', [SocialController::class,"redirect"]);
Route::get('login/facebook/callback', [SocialController::class,'callback']);



Route::group([

    'prefix'=>'reviews',
    'controller'=>ٍReviewController::class

],function(){

    Route::post('/{post_id}/add','store');
    Route::post('/{id}','delete');
    Route::put('/{id}/edit','update');

});

Route::group([

    'prefix'=>'posts',
    'controller'=>PostController::class

],function(){

    Route::get('/home','index');
    Route::get('/waiting','waiting_list');
    Route::get('/{id}','show');
    Route::post('/add','store');
    Route::post('/{id}','delete');
    Route::put('/{id}/edit','update');
    Route::put('/{id}/admin/edit','update_admin')->middleware('auth:admin');
    Route::get('/search/{query}','search');
    Route::get('/category/{category}','get_category');

});

Route::group([

    'prefix'=>'password',
    'controller'=>ResetPasswordController::class

],function(){

    Route::post('/email', 'forget_password');
    Route::post('/code/check', 'code_validate');
    Route::post('/reset','reset_password');

});

Route::group([

    'prefix'=> "auth/",

],function (){

    Route::group([

        'prefix' => 'user',
        'controller'=>UserController::class,

    ], function () {

        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::post('/logout', 'logout');
        Route::post('/refresh', 'refresh');
        Route::put('/edit', 'update');
        Route::get('/{token}', 'verify_email');
        Route::post('/user-profile', 'userProfile');
        Route::post('/profileimg','update_profileIMG');

    });

    Route::group([

        'prefix' => 'admin',
        'controller'=>AdminController::class,

    ], function () {

        Route::post('/login', 'login');
        Route::post('/register','register');
        Route::post('/logout', 'logout');
        Route::post('/refresh','refresh');
        Route::get('/user-profile','userProfile');

    });

});

