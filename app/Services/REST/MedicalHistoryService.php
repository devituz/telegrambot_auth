<?php

namespace App\Services\REST;

use App\Models\MedicalHistory;
use App\Repositories\Core\MedicalHistoryRepository;

class MedicalHistoryService extends _RestBaseService
{
    public function __construct(
        protected MedicalHistoryRepository $medicalHistoryRepository,
    )
    {
    }

    public function all(): \Illuminate\Http\JsonResponse
    {
        $medicalHistories = $this->medicalHistoryRepository->getAllModels();
        if (empty($medicalHistories))
            return $this->error(__("Kasallik tarixlari topilmadi"));

        return $this->success($medicalHistories);
    }

    public function store($post): \Illuminate\Http\JsonResponse
    {
        /** @var MedicalHistory|bool $newMedicalHistory */
        $newMedicalHistory = $this->saveNewMedicalHistory($post, new MedicalHistory());
        if ($newMedicalHistory === false)
            return $this->error(__("Kasallik tarixi qo'shishda xatolik"));

        return $this->success($newMedicalHistory);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        /** @var MedicalHistory $medicalHistory */
        $medicalHistory = $this->medicalHistoryRepository->getModelById($id);
        if (is_null($medicalHistory))
            return $this->error(__("Kasallik tarixi $id topilmadi"));

        return $this->success($medicalHistory);
    }

    public function update($post, $id): \Illuminate\Http\JsonResponse
    {
        /** @var MedicalHistory $medicalHistory */
        $medicalHistory = $this->medicalHistoryRepository->getModelById($id);
        if (is_null($medicalHistory))
            return $this->error(__("Kasallik tarixi $id topilmadi"));

        $newMedicalHistory = $this->saveNewMedicalHistory($post, $medicalHistory, true);
        if ($newMedicalHistory === false)
            return $this->error(__("Kasallik tarixi ma'lumotlartini o'zgartirishda xatolik"));

        return $this->success($newMedicalHistory);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        /** @var MedicalHistory $medicalHistory */
        $medicalHistory = $this->medicalHistoryRepository->getModelById($id);
        if (is_null($medicalHistory))
            return $this->error(__("Kasallik tarixi $id topilmadi"));

        if ($medicalHistory->delete())
            return $this->success(__("Kasallik tarixi $id o'chirildi"));

        return $this->error(__("Kasallik tarixi $id o'chirishda xatolik"));
    }

    private function saveNewMedicalHistory($post, MedicalHistory $medicalHistory, $update = false): MedicalHistory|bool
    {
        $medicalHistory->history = $post['history'];

        if (!$update)
            $medicalHistory->patient_id = $post['patient_id'];

        /** @var MedicalHistory $newMedicalHistory */
        $newMedicalHistory = $this->medicalHistoryRepository->store($medicalHistory);
        if (is_null($newMedicalHistory))
            return false;

        return $newMedicalHistory;
    }

}
