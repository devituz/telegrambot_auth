<?php

namespace App\Services\REST;

use App\Models\MedicalHistory;
use App\Models\Patient;
use App\Models\Phone;
use App\Repositories\Core\MedicalHistoryRepository;
use App\Repositories\Core\PatientRepository;
use App\Repositories\Core\PhoneRepository;

class PatientService extends _RestBaseService
{
    public function __construct(
        protected PatientRepository        $patientRepository,
        protected PhoneRepository          $phoneRepository,
        protected MedicalHistoryRepository $medicalHistoryRepository
    )
    {
    }

    public function all(): \Illuminate\Http\JsonResponse
    {
        $patients = $this->patientRepository->getAllModels();
        if (empty($patients))
            return $this->error(__("Bemorlar topilmadi"));

        return $this->success($patients);
    }

    public function store($post): \Illuminate\Http\JsonResponse
    {
        /*$patient = $this->patientRepository->getModelByColumnsValues(
            ['firstname', 'lastname', 'brith_day', 'gender'],
            [$post['firstname'], $post['lastname'], $post['brith_day'], $post['gender']]
        );

        if (empty($patient))
            $patient = new Patient();
        */

        /** @var Patient|bool $newPatient */
        $newPatient = $this->saveNewPatient($post, new Patient());
        if ($newPatient === false)
            return $this->error(__("Yangi bemor qo'shishda xatolik"));

        if (!empty($post['phones'])) {

            foreach ($post['phones'] as $phoneNumber) {
                $phone = new Phone();
                $phone->number = $phoneNumber['number'];
                $phone->patient_id = $newPatient->id;
                $this->phoneRepository->store($phone);
            }
        }

        if (!empty($post['medical_histories'])) {

            foreach ($post['medical_histories'] as $medical_history) {
                $history = new MedicalHistory();
                $history->history = $medical_history['history'];
                $history->patient_id = $newPatient->id;
                $this->medicalHistoryRepository->store($history);
            }
        }

        return $this->success($newPatient->id);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        /** @var Patient $patient */
        $patient = $this->patientRepository->getModelByIdWithRelations($id, ['phones', 'medical_histories']);
        if (is_null($patient))
            return $this->error(__("Bemor $id topilmadi"));

        $data = [
            'patient' => $patient,
        ];

        return $this->success($data);
    }

    public function update($post, $id): \Illuminate\Http\JsonResponse
    {
        /** @var Patient $patient */
        $patient = $this->patientRepository->getModelById($id);
        if (is_null($patient))
            return $this->error(__("Bemorlar $id topilmadi"));

        $newPatient = $this->saveNewPatient($post, $patient);
        if ($newPatient === false)
            return $this->error(__("Bemor ma'lumotlartini o'zgartirishda xatolik"));

        return $this->success($newPatient);
    }


    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        /** @var Patient $patient */
        $patient = $this->patientRepository->getModelById($id);
        if (is_null($patient))
            return $this->error(__("Bemor $id topilmadi"));

        if ($patient->delete())
            return $this->success(__("Bemor $id o'chirildi"));

        return $this->error(__("Bemor $id o'chirishda xatolik"));
    }

    private function saveNewPatient($post, Patient $patient): Patient|bool
    {
        $patient->firstname = $post['firstname'];
        $patient->lastname = $post['lastname'];
        $patient->brith_day = $post['brith_day'];
        $patient->gender = $post['gender'];
        $patient->address = $post['address'];
        $patient->rengen = $post['rengen'];
        $patient->description = $post['description'];
        $patient->user_id = auth('sanctum')->user()->id;

        /** @var Patient $newPatient */
        $newPatient = $this->patientRepository->store($patient);
        if (is_null($newPatient))
            return false;

        return $newPatient;
    }

}
