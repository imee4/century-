<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\AdminController;
use \App\Http\Controllers\EmailController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\GroupController;
use \App\Http\Controllers\BirthdayController;
use \App\Http\Controllers\TestController;
use \App\Http\Controllers\NotificationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/ttt', [AuthController::class, 'ttt']);
Route::get('/sms', [NotificationController::class, 'twilioSms']);

// Route::group(['middleware' => 'auth:sanctum',], function (){
     Route::get('/test', [NotificationController::class, 'twilioSms']);
// });

// Route::get('/meow', [TestController::class, 'meow'])->middleware('admin');


Route::group(['middleware' => 'auth:sanctum',], function (){

    Route::get('/meow', [TestController::class, 'meow'])->middleware('admin');

    Route::get('/admins', [AdminController::class, 'index'])->middleware('admin');
    Route::get('/admin/users-count', [AdminController::class, 'usersCount'])->middleware('admin');
    Route::post('/admin/register', [EmailController::class, 'store']);
    Route::get('/admin/{id}', [AdminController::class, 'show'])->middleware('admin');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->middleware('admin');
    Route::post('/admin/make-admin', [AdminController::class, 'createAdmin'])->middleware('admin');
    Route::get('/admin/birthdays', [AdminController::class, 'birthday']);

    Route::get('/admin/groups', [GroupController::class, 'index'])->middleware('admin');
    Route::post('/admin/store-group', [GroupController::class, 'register'])->middleware('admin');
    Route::get('/admin/group/{id}', [GroupController::class, 'show'])->middleware('admin');
    Route::post('/admin/group/{id}', [GroupController::class, 'update'])->middleware('admin');
});

Route::group(['middleware' => 'auth:sanctum',], function (){
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/user/register', [UserController::class, 'store']);
    Route::get('/user/birthdays', [BirthdayController::class, 'showBirthday']);
    Route::post('/user/{id}', [UserController::class, 'update']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/test', [TestController::class, 'index']);


});








