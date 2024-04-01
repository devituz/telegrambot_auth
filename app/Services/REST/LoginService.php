<?php

namespace App\Services\REST;

use App\Models\User;
use App\Repositories\Core\UserRepository;

class LoginService extends _RestBaseService
{
    public function __construct(
        protected UserRepository $userRepository
    )
    {
    }

    public function login($post): \Illuminate\Http\JsonResponse
    {
        /** @var User $user */
        $user = $this->userRepository->getModelByColumnValue('password', $post['numbers']);
        if (is_null($user))
            return $this->error(__("Foydalanuvchi password = " . $post['numbers'] . " bo'yicha topilmadi"));

        if ($user->updated_at->diffInMinutes() >= 1)
            return $this->error(__('Bir daqiqalik parol muddati tugadi, yangi parol oling'));

        $user->tokens()->delete();

        $token = $user->createToken($user->telegram_id . '-AuthToken')->plainTextToken;

        return $this->success([
            'token' => $token,
            'user' => $user
        ]);
    }

}
