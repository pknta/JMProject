<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminController;

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
});

Auth::routes();

Route::get('/home', [HomeController::class, 'getStock'])->name('stocklist');
Route::post('/home', [HomeController::class, 'addTransaction'])->name('transaction.add');
Route::post('/home/{prodid}', [HomeController::class, 'updateTransaction'])->name('transaction.update');
Route::delete('/home/{transaction_detail}', [HomeController::class, 'delete'])->name('transaction.delete');

Route::post('/editprofile', [HomeController::class, 'upload'])->name('uploadpict');
Route::get('/editprofile', [HomeController::class, 'editprofile'])->name('editprofile');


Route::get('/transaction', [HomeController::class, 'viewTransaction'])->name('viewTransaction');
Route::post('/transaction', [TransactionController::class, 'calKembalian'])->name('kembalian');
Route::get('/transactionend', [HomeController::class, 'finalTransaction'])->name('akhir');

Route::get('/transaction_history', [HomeController::class, 'viewHistory'])->name('history');

Route::group(['middleware' => ['admin']], function () {
    Route::get('/manage_user', [AdminController::class, 'manage_user'])->name('user.view');
    Route::get('/staff_history/{staff_id}', [AdminController::class, 'view_user_history'])->name('user.history');
    Route::delete('/delete_user/{user_id}', [AdminController::class, 'delete_user'])->name('user.delete');
});

// google login
Route::get('/auth/redirect', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider']);
Route::get('/auth/callback', [App\Http\Controllers\Auth\LoginController::class,'handleProviderCallback']);
