<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

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


//login user
Route::post('/V1/signin', [AuthenticationController::class, 'signin']);
//using middleware
Route::group(['middleware' => ['auth:sanctum'],'prefix'=>'V1'], function () {   
    Route::get('/qrcode/generate', [AuthenticationController::class, 'qrCodeGenerate']);
    Route::post('/qrcode/check', [AuthenticationController::class, 'qrCodeCheck']);
    Route::post('/qrcode/pay', [AuthenticationController::class, 'payAmount']);
    Route::get('/transaction/show', [AuthenticationController::class, 'showTransaction']);
    Route::get('/wallet/amount', [AuthenticationController::class, 'walletAmount']);
    Route::get('/profile', function(Request $request) {
            return auth()->user();
    });
    Route::get('/profile/edit', [AuthenticationController::class, 'profileEdit']);
    Route::post('/profile/update', [AuthenticationController::class, 'profileUpdate']);
    Route::post('/sign-out', [AuthenticationController::class, 'logout']);
});

