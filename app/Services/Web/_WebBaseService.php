<?php

namespace App\Services\Web;

use App\Services\BaseService;
use Illuminate\Support\Facades\Session;

class _WebBaseService extends BaseService
{
    public function error(array $data): bool
    {
        Session::flash($data[0], __($data[1]));     # 0 => name , 1 => value
        return false;
    }

}
