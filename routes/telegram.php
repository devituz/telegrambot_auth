<?php
/** @var SergiX44\Nutgram\Nutgram $bot */

use App\Telegram\LoginWithRandomNumberService;
use SergiX44\Nutgram\Nutgram;

$bot->onCommand('start', function (Nutgram $bot, LoginWithRandomNumberService $telegramService) {
    $telegramService->start($bot);
});

$bot->onCommand('login', function (Nutgram $bot, LoginWithRandomNumberService $telegramService) {
    $telegramService->login($bot);
});

$bot->onContact(function (Nutgram $bot, LoginWithRandomNumberService $telegramService) {
    $telegramService->saveUserWithContact($bot);
});
