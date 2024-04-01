<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "Stom Medhubs UZ";
});

Route::get('/telegram/setWebhook', 'App\Http\Controllers\REST\Telegram\TelegramWebhook');

