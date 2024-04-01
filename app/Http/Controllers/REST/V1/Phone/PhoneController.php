<?php

namespace App\Http\Controllers\REST\V1\Phone;

use App\Http\Controllers\Controller;
use App\Http\Requests\REST\PhoneRequest;
use App\Services\REST\PhoneService;

class PhoneController extends Controller
{

    public function __construct(
        protected PhoneService $service
    )
    {
    }

    public function index()
    {
        return $this->service->all();
    }

    public function store(PhoneRequest $request)
    {
        return $this->service->store($request->post());
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function update(PhoneRequest $request, $id)
    {
        return $this->service->update($request->post(), $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }


}
