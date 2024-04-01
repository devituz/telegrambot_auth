<?php

namespace App\Http\Controllers\REST\Telegram;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Exceptions\TelegramException;

class TelegramWebhook extends Controller
{

    public function __invoke(Nutgram $bot)
    {
        $webhook = config('nutgram.webhook');
        $webhook .= 'api/bot/telegram/update';

        try {

            $result = $bot->setWebhook($webhook);
            if ($result)
                logInfo('telegram webhook successful');

        } catch (GuzzleException|\JsonException|TelegramException $e) {
            logError($e);
        }
    }
}
