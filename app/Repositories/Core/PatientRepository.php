<?php

namespace App\Repositories\Core;

use App\Models\Patient;
use App\Repositories\BaseRepository;

class PatientRepository extends BaseRepository
{
    public function __construct(Patient $patient)
    {
        parent::__construct($patient);
    }
}
