<?php

namespace App\Services\Web;

use App\Models\Phone;
use App\Models\User;
use App\Repositories\Core\PhoneRepository;
use App\Repositories\Core\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * @author NurbekMakhmudov
 */
class RegisterService extends _WebBaseService
{

    public function __construct(
        protected UserRepository $userRepository,
        protected PhoneRepository $phoneRepository
    )
    {
    }

    private function store(array $data): bool
    {
        /** @var Phone $phone */
        $phone = $this->phoneRepository->getModelByColumnValue('number', clearPhone($data['phone']));
        if (is_null($phone))
            return $this->error(['error_phone', "Telefon raqam noto'g'ri"]);

        /** @var User $user */
        $user = $this->userRepository->getModelById($phone->user_id);
        if (is_null($user))
            return $this->error(['error_phone', "Foydalanuvchi telefon raqam bo'yicha topilmadi"]);

        if (!Hash::check($data['password'], $user->password))
            return $this->error(['error_password', "Parol noto'g'ri"]);

        event(new Registered($user));
        Auth::login($user);

        return true;
    }

}
