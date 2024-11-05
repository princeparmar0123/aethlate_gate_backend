<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SettingController;
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
    Route::group(['middleware' => ['admin']], function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        #setting
        Route::get('setting/change/password', [SettingController::class, 'index'])->name('admin.change.password');
        Route::post('password-change', [SettingController::class, 'changePassword'])->name('admin.update.password');

        //   #Parent Category
        //   Route::get('parent/category', [ParentController::class, 'catIndex'])->name('parent.category.index');
        //   Route::post('parent/category/store', [ParentController::class, 'catStore'])->name('parent.cat.store');
        //   Route::post('parent/category/edit/{id}', [ParentController::class, 'catEdit'])->name('parent.cat.edit.store');
        //   Route::get('parent/category/delete/{id}', [ParentController::class, 'catDelete'])->name('parent.cat.delete');
        //   Route::post('parent/category/status', [ParentController::class, 'catStatus'])->name('parent.cat.status');

        //   #Product
        //   Route::get('product', [ProductController::class, 'index'])->name('product.index');
        //   Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
        //   Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
        //   Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        //   Route::post('product/edit/{id}', [ProductController::class, 'update'])->name('product.update');
        //   Route::get('product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

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
