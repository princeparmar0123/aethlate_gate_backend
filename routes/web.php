<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SportsController;
use App\Http\Controllers\Backend\VendorController;
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

Auth::routes();

// Route::group(['middleware' => ['admin', 'xss']], function () {
//     // add frontend here with xss 
// });


Route::prefix('/admin')->group(function () {
    Route::get('login', [LoginController::class, 'adminLogin'])->name('admin.login');
    Route::get('otp/verify/form', [LoginController::class, 'otpVerifyForm'])->name('otp.verify.form');
    Route::post('otp/verify', [LoginController::class, 'otpVerify'])->name('otp.verify');
    // Route::group(['middleware' => ['admin', 'xss']], function () {

    Route::group(['middleware' => ['admin','auth']], function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        #setting
        Route::get('setting/change/password', [SettingController::class, 'index'])->name('admin.change.password');
        Route::post('password-change', [SettingController::class, 'changePassword'])->name('admin.update.password');

          #Sports
          Route::get('sports', [SportsController::class, 'index'])->name('sports');
          Route::post('sports/store', [SportsController::class, 'store'])->name('sport.store');
          Route::post('sports/edit/{id}', [SportsController::class, 'edit'])->name('sport.edit.store');
          Route::get('sports/delete/{id}', [SportsController::class, 'delete'])->name('sport.delete');

          #Vendor 
          Route::get('vendor', [VendorController::class, 'index'])->name('vendor.index');
          Route::get('vendor/{status}/approval/{user}/status', [VendorController::class, 'approvalStatus'])->name('vendor.approval.status');
          Route::get('vendor/{user}/details', [VendorController::class, 'vendorDetails'])->name('vendor.details');

        //   #Blog
        //   Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
        //   Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');
        //   Route::post('blog/store', [BlogController::class, 'store'])->name('blog.store');
        //   Route::get('blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
        //   Route::post('blog/edit/{id}', [BlogController::class, 'update'])->name('blog.update');
        //   Route::get('blog/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');

        //   #contact
        //   Route::get('contacts', [ProductController::class, 'contact'])->name('contact.index');
        //   Route::get('comments', [ProductController::class, 'comment'])->name('comment.index');
        //   Route::get('comment/approve/{id}', [ProductController::class, 'commentApprove'])->name('comment.approve');


    });
});
