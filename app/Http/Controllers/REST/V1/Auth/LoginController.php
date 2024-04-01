<?php

namespace App\Http\Controllers\REST\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\REST\LoginRequest;
use App\Services\REST\LoginService;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __construct(protected LoginService $service,)
    {
    }

    function login(LoginRequest $request)
    {
        return $this->service->login($request->post());
    }

}
