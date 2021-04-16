<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserItemController;
use App\Http\Controllers\Broadcast\AttendanceController;
use App\Http\Controllers\Broadcast\DTRController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/users')->group(function() 
    {
        Route::get('/',[UserController::class, 'index']);
        // Route::put('/pk',[UserController::class, 'storeChange']);
        // Route::get('/',[AdminController::class, 'index']);
        Route::get('/list',[UserController::class, 'list']);
        Route::get('/{user}/look',[UserController::class, 'find']);
        // Route::get('/item/show',[UserItemController::class, 'show']);
        Route::get('/{email}/hasExist',[UserController::class, 'hasExist']);
        Route::post('/save',[UserController::class, 'save']);
        Route::put('/{user}/update',[UserController::class, 'update']);
        Route::put('/{user}/change',[UserController::class, 'change']);
        Route::delete('/{user}/destroy',[UserController::class, 'destroy']);
        Route::put('/{user}/updateOrCreate',[UserController::class, 'hasDownloaded']);

    });
    Route::prefix('/admins')->group(function() 
    {
        Route::get('/',[AdminController::class, 'index']);
        Route::get('/list',[AdminController::class, 'list']);
        Route::get('/{user}/look',[AdminController::class, 'find']);
        Route::get('/{email}/hasExist',[AdminController::class, 'hasExist']);
        Route::post('/save',[AdminController::class, 'save']);
        Route::put('/{user}/update',[AdminController::class, 'update']);
        Route::put('/{user}/change',[AdminController::class, 'change']);
        Route::delete('/{user}/destroy',[AdminController::class, 'destroy']);
    });
Route::prefix('/companies')->group(function() 
    {
        Route::get('/',[CompanyController::class, 'indexA']);
        Route::get('/user',[CompanyController::class, 'indexU']);
        Route::get('/list',[CompanyController::class, 'list']);
        Route::get('/{company}/find',[CompanyController::class, 'find']);
        Route::post('/save',[CompanyController::class, 'save']);
        Route::put('/{company}/update',[CompanyController::class, 'update']);
        Route::delete('/{company}/destroy',[CompanyController::class, 'destroy']);
    });

Route::prefix('/user_items')->group(function() 
    {
        Route::get('/',[UserItemController::class, 'index']);
        Route::get('/list',[UserItemController::class, 'list']);
        Route::get('/{user}/find',[UserItemController::class, 'find']);
        Route::post('/save',[UserItemController::class, 'save']);
        Route::post('/{user}/updateOrCreate',[UserItemController::class, 'company']);
        Route::put('/{useritem}/update',[UserItemController::class, 'update']);
        Route::delete('/{user}/destroy',[UserItemController::class, 'destroy']);
    });
Route::prefix('/articles')->group(function() 
    {
        Route::get('/',[ArticleController::class, 'index']);
        Route::get('/list',[ArticleController::class, 'list']);
        Route::post('/save',[ArticleController::class, 'save']);
        Route::get('/{article}/find',[ArticleController::class, 'find']);
        Route::put('/{article}/update',[ArticleController::class, 'update']);
        Route::delete('/{article}/destroy',[ArticleController::class, 'destroy']);
    });


Route::prefix('/attendances')->group(function() 
    {
        Route::get('/',[AttendanceController::class, 'index']);
        Route::get('/list',[AttendanceController::class, 'list']);
        Route::get('/{attendance}/find',[AttendanceController::class, 'find']);
        Route::post('/save',[AttendanceController::class, 'save']);
        Route::put('/{attendance}/update',[AttendanceController::class, 'update']);
        Route::delete('/{attendance}/destroy',[AttendanceController::class, 'destroy']);

       
    });

    Route::prefix('/dtr')->group(function() 
    {

        Route::get('/',[DTRController::class, 'index']);
        Route::get('/list',[DTRController::class, 'list']);
        Route::get('/{rfid}/find',[DTRController::class, 'find']);
        Route::post('/save',[DTRController::class, 'save']);
        Route::put('/{statement}/update',[DTRController::class, 'update']);
        Route::delete('/{statement}/destroy',[DTRController::class, 'destroy']);


        
    });
