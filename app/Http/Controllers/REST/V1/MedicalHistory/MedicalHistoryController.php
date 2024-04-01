<?php

namespace App\Http\Controllers\REST\V1\MedicalHistory;

use App\Http\Controllers\Controller;
use App\Http\Requests\REST\MedicalHistoryRequest;
use App\Services\REST\MedicalHistoryService;

class MedicalHistoryController extends Controller
{

    public function __construct(
        protected MedicalHistoryService $service
    )
    {
    }

    public function index()
    {
        return $this->service->all();
    }

    public function store(MedicalHistoryRequest $request)
    {
        return $this->service->store($request->post());
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function update(MedicalHistoryRequest $request, $id)
    {
        return $this->service->update($request->post(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }


}
