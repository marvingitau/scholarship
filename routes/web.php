<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Clerk\ClerkDashboardController;
use App\Http\Controllers\Clerk\BeneficiaryformController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Admin
Route::group(['middleware'=>'role:admin','prefix'=>'admin'],function () {
    Route::group(['namespace'=>'Admin'],function () {
        Route::get('/', [AdminDashboardController::class,'index'])->name('admin.dashboard');

    });
}); 

// Clerk
Route::group(['middleware'=>'role:clerk','prefix'=>'clerk'],function(){

    Route::group(['namespace'=>'Clerk'],function(){
        Route::get('/', [ClerkDashboardController::class,'index'])->name('clerk.dashboard');
        // Beneficiary form urls
        Route::get('/new-application',[BeneficiaryformController::class,'index'])->name('clerk.newapplication');

    });
});

