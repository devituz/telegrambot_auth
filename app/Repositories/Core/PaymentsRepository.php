<?php

namespace App\Repositories\Core;

use App\Models\Payment;
use App\Repositories\BaseRepository;

class PaymentsRepository extends BaseRepository
{
    public function __construct(Payment $payments)
    {
        parent::__construct($payments);
    }
}
