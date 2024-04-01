<?php

namespace App\Services\REST;

use App\Models\Phone;
use App\Repositories\Core\PhoneRepository;

class PhoneService extends _RestBaseService
{
    public function __construct(
        protected PhoneRepository $phoneRepository,
    )
    {
    }

    public function all(): \Illuminate\Http\JsonResponse
    {
        $phone = $this->phoneRepository->getAllModels();
        if (empty($phone))
            return $this->error(__("Telefon raqam topilmadi"));

        return $this->success($phone);
    }

    public function store($post): \Illuminate\Http\JsonResponse
    {
        /** @var Phone|bool $newPhone */
        $newPhone = $this->saveNewPhone($post, new Phone());
        if ($newPhone === false)
            return $this->error(__("Yangi telefon raqam  qo'shishda xatolik"));

        return $this->success($newPhone);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        /** @var Phone $ph */
        $phone = $this->phoneRepository->getModelById($id);
        if (is_null($phone))
            return $this->error(__("Telefon raqam $id topilmadi"));

        return $this->success($phone);
    }

    public function update($post, $id): \Illuminate\Http\JsonResponse
    {
        /** @var Phone $phone */
        $phone = $this->phoneRepository->getModelById($id);
        if (is_null($phone))
            return $this->error(__("Telefon raqam $id  topilmadi"));

        $newPhone = $this->saveNewPhone($post, $phone, true);
        if ($newPhone === false)
            return $this->error(__("Telefon raqam o'zgartirishda xatolik"));

        return $this->success($newPhone);
    }


    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        /** @var Phone $phone */
        $phone = $this->phoneRepository->getModelById($id);
        if (is_null($phone))
            return $this->error(__("Telefon raqam $id topilmadi"));

        if ($phone->delete())
            return $this->success(__("Telefon raqam $id o'chirildi"));

        return $this->error(__("Telefon raqam $id  o'chirishda xatolik"));
    }

    private function saveNewPhone($post, Phone $phone, $update = false): Phone|bool
    {
        $phone->number = $post['number'];


        if (!$update)
            $phone->patient_id = $post['patient_id'];

        /** @var Phone $newPhone */
        $newPhone = $this->phoneRepository->store($phone);
        if (is_null($newPhone))
            return false;

        return $newPhone;
    }

}
