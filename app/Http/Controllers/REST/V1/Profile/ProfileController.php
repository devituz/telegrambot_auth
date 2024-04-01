<?php

namespace App\Http\Controllers\REST\V1\Profile;

use App\Http\Controllers\Controller;
use App\Services\REST\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __construct(
        protected ProfileService $service
    )
    {
    }

    function profile()
    {
        return $this->service->profile();
    }

    function logout()
    {
        return $this->service->logout();
    }



}
