<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('bot')->group(function () {
    // https://dev.stom.medhubs.uz/api/bot/telegram/update
    Route::post('/telegram/update', 'App\Http\Controllers\REST\Telegram\TelegramUpdateController');
});

Route::prefix('v1')->name('api.v1.') ->group(function (){
    include __DIR__ . '/api_v1.php';
});

