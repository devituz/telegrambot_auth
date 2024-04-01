<?php

namespace App\Repositories\Core;

use App\Models\Phone;
use App\Repositories\BaseRepository;

class PhoneRepository extends BaseRepository
{
    public function __construct(Phone $phone)
    {
        parent::__construct($phone);
    }

}
