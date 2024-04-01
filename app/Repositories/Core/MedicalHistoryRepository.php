<?php

namespace App\Repositories\Core;

use App\Models\MedicalHistory;
use App\Repositories\BaseRepository;

class MedicalHistoryRepository extends BaseRepository
{

    public function __construct(MedicalHistory $medicalHistory)
    {
        parent::__construct($medicalHistory);
    }
}
