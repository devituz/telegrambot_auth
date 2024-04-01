<?php

namespace App\Services\REST;

use App\Repositories\Core\UserRepository;

class ProfileService extends _RestBaseService
{

    public function __construct(
        protected UserRepository $userRepository
    )
    {
    }

    public function profile(): \Illuminate\Http\JsonResponse
    {
        $user_id = auth('sanctum')->user()->id;

        $user = $this->userRepository->getModelById($user_id);
        if (is_null($user))
            return $this->error(__("Foydalanuvchi $user_id bo'yicha topilmadi"));

        return $this->success($user);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth('sanctum')->user()->tokens()->delete();

        return $this->success([
            'message' => __("Foydalanuvchi tizimdan muvaffaqiyatli chiqdi")
        ]);
    }
}
