<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('id');

Auth::routes();  

Route::get('/item/show',[App\Http\Controllers\UserItemController::class, 'show']);
Route::get('/company', function () { return view('company.index'); })->name('company');
Route::post('/article/save', [App\Http\Controllers\ArticleController::class, 'save'])->name('article.save');
Route::get('/company', function () { return view('company.index'); })->name('company');

Route::get('/login', function () { return view('welcome'); })->name('login');
Route::get('/register', function () { return view('register'); })->name('register');
Route::get('/fpassword', function () { return view('fpassword'); })->name('fpassword');

Route::get('/admin', function () { return view('admin'); })->name('admin.home');
Route::get('/admin/article', function () { return view('users.article'); })->name('admin.article');
Route::get('/admin/company', function () { return view('users.appCompany'); })->name('admin.company');
Route::get('/admin/list', function () { return view('admins.index'); })->name('admin.lists');
Route::get('/admin/viewLogs', function () { return view('users.tapID'); })->name('tapID');
Route::get('/id/admin/qr', function () { return view('users.showId'); })->name('show.qr');
Route::get('/id/admin/br', function () { return view('users.showId'); })->name('show.br');

Route::post('/user/register', [App\Http\Controllers\Auth\RegisterController::class, 'save'])->name('user.register');
Route::post('/users/list', [App\Http\Controllers\UserController::class, 'save'])->name('user.ban');
Route::get('/users/list', function () { return view('users.userList'); })->name('user.list');
Route::get('/user/{user}/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::get('/user/article', function () { return view('users.userArticle'); })->name('user.article');
Route::get('/user/company', function () { return view('users.userCompany'); })->name('user.company');
Route::get('/id/user/qr', function () { return view('users.showUserId'); })->name('show.Uqr');
Route::get('/id/user/br', function () { return view('users.showUserId'); })->name('show.Ubr');
Route::get('/user-item', function () { return view('users.userItem'); });
Route::get('/user/item', function () { return view('users.item'); })->name('user.item');


Route::get('change-password', [App\Http\Controllers\UserController::class, 'indexChange']);
Route::post('change-password', [App\Http\Controllers\UserController::class, 'storeChange'])->name('change.password');


Route::post('/company/save', [App\Http\Controllers\CompanyController::class, 'save'])->name('company.store');

// Route::get('change-password', [App\Http\Controllers\ChangePasswordController::class, 'indexChange']);
// Route::post('change-password', [App\Http\Controllers\ChangePasswordController::class, 'storeChange'])->name('change.password');
