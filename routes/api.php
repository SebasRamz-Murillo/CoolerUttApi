<?php

use App\Http\Controllers\adafruitController;
use App\Http\Controllers\carController;
use App\Http\Controllers\feedController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\userController;
use App\Http\Controllers\verificarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::prefix('/v1')->group(function () {
    Route::get('/hola', function () {
        return 'Hola mundo';
    });
});

Route::post('/reg', [LoginController::class, 'register']);
Route::post('/in', [LoginController::class, 'login']);
Route::post('/out', [LoginController::class, "logout"])->middleware('auth:sanctum');

Route::get('/verificarTelefono',[verificarController::class,'telefono'],function(){
})->name('verificarTelefono')->middleware('signed');
Route::post('/verificarCodigo',[verificarController::class,'codigo'],function(){
})->name('codigo')->middleware('signed');
Route::get('segundoCorreo',[verificarController::class,'segundoCorreo'],function(){
})->name('correo')->middleware('signed');

Route::middleware('auth:sanctum')->group(function(){
    Route::middleware('status')->group(function(){
        Route::middleware('rol:1')->group(function(){
            Route::post('/feed',[feedController::class,'addFeed']);
            Route::put('/feedss/{id}',[feedController::class,'updateFeed'])->where('id','[0-9]+');
            Route::post('/car',[carController::class,'addCar']);
            Route::get('/cars',[carController::class,'viewCar']);
            Route::put('/car{id}',[carController::class,'updateCar'])->where('id','[0-9]+');
            Route::post('/data',[adafruitController::class,'createData']);
            Route::get('/datas',[adafruitController::class,'seeData']);
            Route::post('/group',[feedController::class,'createGroup']);
            Route::get('/feed_group/{id}',[feedController::class,'feed_group'])->where('id','[0-9]+');
            Route::get('/feedgroup',[feedController::class,'showFeed_group']);
            Route::get('/feeds/{id}',[feedController::class,'showFeed'])->where('id','[0-9]+');
            Route::get('/gruposs/{id}',[carController::class,'gruposss'])->where('id','[0-9]+');
            Route::put('/user/{id}', [userController::class, 'updateUser'])->where('id','[0-9]+');
            Route::get('/users/{id}', [userController::class, 'showUser'])->where('id','[0-9]+');
            Route::get('/adafruit/{id}', [userController::class, 'adafruit'])->where('id','[0-9]+');
        });
    });
});

Route::get('vista',function(){
    return view('primero',['status'=>200]);
},200);
