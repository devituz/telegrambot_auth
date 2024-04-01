<?php

namespace App\Http\Controllers\REST\Telegram;

use App\Http\Controllers\Controller;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SergiX44\Nutgram\Nutgram;

class TelegramUpdateController extends Controller
{
    public function __invoke(Nutgram $bot)
    {
        try {
            $bot->run();
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            logError($e);
        }
    }

}
