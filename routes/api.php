<?php

use App\Http\Controllers\Apis\Auth\AuthController;
use App\Http\Controllers\Apis\ComplexController;
use App\Http\Controllers\Apis\LocationController;
use App\Http\Controllers\Apis\PackageController;
use App\Http\Controllers\Apis\SportsController;
use App\Http\Controllers\Apis\User\MainController;
use App\Http\Controllers\Apis\VendorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register/user', [AuthController::class, 'userRegister']);
Route::post('register/vendor', [AuthController::class, 'vendorRegister']);
Route::post('login', [AuthController::class, 'login']);
Route::post('vendor/login', [AuthController::class, 'vendorLogin']);

Route::get('get/sports/list', [SportsController::class, 'getSportsList']);
Route::post('get/vendor/approval/status', [VendorController::class, 'getVendorApprovalStatus']);

Route::middleware('auth:api')->group(function () {
    Route::get('get/vendor/location/list', [LocationController::class, 'getLocationList']);

    Route::post('vendor/add/sport', [SportsController::class, 'addSport']);

    Route::get('get/vendor/package/list', [PackageController::class, 'getPackageList']);

    Route::post('vendor/add/package', [PackageController::class, 'addPackage']);

    Route::post('vendor/add/location', [LocationController::class, 'addLocation']);

    Route::post('vendor/add/complex', [ComplexController::class, 'addComplex']);

    Route::get('get/vendor/complex/list', [ComplexController::class, 'getComplexList']);

    //user section
    Route::get('user/sport/complexes', [MainController::class, 'getSportComplexes']);


});
