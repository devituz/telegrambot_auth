<?php

namespace App\Telegram;

use App\Models\User;
use App\Repositories\Core\UserRepository;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;
use SergiX44\Nutgram\Telegram\Types\Keyboard\KeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\ReplyKeyboardMarkup;

class LoginWithRandomNumberService
{

    public function __construct(
        protected UserRepository $userRepository
    )
    {
    }

    public function start(Nutgram $bot): void
    {
        $first_name = $bot->user()->first_name;
        $bot->sendMessage(
            text: "Salom  $first_name 👋 \n\n@StomMedhubs rasmiy botiga xush kelibsiz \n\n⬇️ Kontaktingizni yuboring (tugmani bosib)",
            reply_markup: ReplyKeyboardMarkup::make(resize_keyboard: true, one_time_keyboard: true, is_persistent: true)
                ->addRow(
                    KeyboardButton::make(text: "☎️ Kontaktni yuborish", request_contact: true)
                )
        );
    }

    public function saveUserWithContact(Nutgram $bot): void
    {
         logInfo($bot->message()->contact->phone_number);

        /** @var User $user */
        $user = $this->userRepository->getModelByColumnValue('phone', substr($bot->message()->contact->phone_number, 1));
        if (is_null($user)) {
            $user = new User();
            $user->phone = $bot->message()->contact->phone_number;
            $user->telegram_id = $bot->user()->id;
        }

        $this->saveOrReStart($bot, $user);
    }

    public function login(Nutgram $bot): void
    {
        /** @var User $user */
        $user = $this->userRepository->getModelByColumnValue('telegram_id', $bot->user()->id);
        if (is_null($user)) {
            $this->reStart($bot);
        } else {
            $this->saveOrReStart($bot, $user);
        }
    }

    private function saveOrReStart(Nutgram $bot, User $user): void
    {
        $password = (string)rand(100000, 999999);

        $user->firstname = $bot->user()->first_name;
        $user->lastname = $bot->user()->last_name ?? '';
        $user->username = $bot->user()->username ?? '';
        $user->password = $password;

        /** @var User $newUser */
        $newUser = $this->userRepository->store($user);

        if ($newUser->exists()) {

            $newPassword = '';
            for ($i = 0; $i < strlen($password); $i++)
                $newPassword .= $password[$i] . ' ';

            $bot->sendMessage(
                text: "🔒 Kodingiz: \n\n <code> $newPassword </code> \n\n 🔑 Yangi kod olish uchun /login ni bosing",
                parse_mode: ParseMode::HTML,
            );
        } else {
            logDebug($newUser);
            $this->reStart($bot);
        }
    }

    private function reStart(Nutgram $bot): void
    {
        $bot->sendMessage(
            text: "Qayta boshlash uchun 👉🏻 /start ni bosing",
            parse_mode: ParseMode::HTML,
        );
    }
}
