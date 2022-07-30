<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\DashboardController;
use App\Models\Table;
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

Route::get('/',[DashboardController::class,'index']);
Route::get('table-detail/{table}/edit',[DashboardController::class,'detailTable']);
Route::post('booking',[DashboardController::class,'booking']);


Route::get('reset-pass/{id}',[LoginController::class,'resetPass']);

Route::get('logout', [LoginController::class,'logout']);

Route::middleware(['ifauth'])->group(function(){
    Route::view('login','auth.login');
    Route::post('login',[LoginController::class,'authenticate']);
});

Route::middleware(['auth.admin'])->group(function(){
    Route::get('admin-dashboard',function () {
        return view('admin.index');
    });
    Route::resource('category', CategoryController::class);
    Route::resource('menu', MenuController::class)->except('update');
    Route::resource('users',UserController::class);
    Route::resource('table',TableController::class);
    Route::post('menu-update',[MenuController::class,'update']);
});

