<?php

namespace App\Http\Controllers\REST\V1\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\REST\PatientRequest;
use App\Services\REST\PatientService;

class PatientController extends Controller
{

    public function __construct(
        protected PatientService $service
    )
    {
    }

    public function index()
    {
        return $this->service->all();
    }

    public function store(PatientRequest $request)
    {
        return $this->service->store($request->post());
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function update(PatientRequest $request, $id)
    {
        return $this->service->update($request->post(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }


}
