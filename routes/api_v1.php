<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('login', [\App\Http\Controllers\REST\V1\Auth\LoginController::class, 'login'])->name('login');
});


Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::post('/', [\App\Http\Controllers\REST\V1\Profile\ProfileController::class, 'profile']);
        Route::post('logout', [\App\Http\Controllers\REST\V1\Profile\ProfileController::class, 'logout'])->name('logout');
    });

    Route::apiResource('patient', \App\Http\Controllers\REST\V1\Patient\PatientController::class);
    Route::apiResource('payment', \App\Http\Controllers\REST\V1\Payment\PaymentController::class);
    Route::apiResource('phone', \App\Http\Controllers\REST\V1\Phone\PhoneController::class);



});





