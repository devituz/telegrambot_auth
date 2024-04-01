<?php

namespace App\Services\REST;

use App\Models\Payment;
use App\Repositories\Core\PaymentsRepository;

class PaymentService extends _RestBaseService
{
    public function __construct(
        protected PaymentsRepository $paymentsRepository,
    )
    {
    }

    public function all(): \Illuminate\Http\JsonResponse
    {
        $payments = $this->paymentsRepository->getAllModels();
        if (empty($payments))
            return $this->error(__("To'lovlar topilmadi"));

        return $this->success($payments);
    }

    public function store($post): \Illuminate\Http\JsonResponse
    {
        /** @var Payment|bool $newPayment */
        $newPayment = $this->saveNewPayment($post, new Payment());
        if ($newPayment === false)
            return $this->error(__("Yangi to'lov qo'shishda xatolik"));

        return $this->success($newPayment);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        /** @var Payment $payment */
        $payment = $this->paymentsRepository->getModelById($id);
        if (is_null($payment))
            return $this->error(__("To'lov $id topilmadi"));

        return $this->success($payment);
    }

    public function update($post, $id): \Illuminate\Http\JsonResponse
    {
        /** @var Payment $payment */
        $payment = $this->paymentsRepository->getModelById($id);
        if (is_null($payment))
            return $this->error(__("To'lov $id topilmadi"));

        $newPayment = $this->saveNewPayment($post, $payment, true);
        if ($newPayment === false)
            return $this->error(__("To'lov ma'lumotlartini o'zgartirishda xatolik"));

        return $this->success($newPayment);
    }


    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        /** @var Payment $payment */
        $payment = $this->paymentsRepository->getModelById($id);
        if (is_null($payment))
            return $this->error(__("To'lov $id topilmadi"));

        if ($payment->delete())
            return $this->success(__("To'lov $id o'chirildi"));

        return $this->error(__("To'lov $id o'chirishda xatolik"));
    }

    private function saveNewPayment($post, Payment $payment, $update = false): Payment|bool
    {
        $payment->number = $post['number'];
        $payment->amount = $post['amount'];
        $payment->day = $post['day'];

        if (!$update)
            $payment->patient_id = $post['patient_id'];

        /** @var Payment $newPayment */
        $newPayment = $this->paymentsRepository->store($payment);
        if (is_null($newPayment))
            return false;

        return $newPayment;
    }

}
