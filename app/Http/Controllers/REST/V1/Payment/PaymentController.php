<?php

namespace App\Http\Controllers\REST\V1\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\REST\PaymentRequest;
use App\Services\REST\PaymentService;

class PaymentController extends Controller
{

    public function __construct(
        protected PaymentService $service
    )
    {
    }

    public function index()
    {
        return $this->service->all();
    }

    public function store(PaymentRequest $request)
    {
        return $this->service->store($request->post());
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function update(PaymentRequest $request, $id)
    {
        return $this->service->update($request->post(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }


}
