<?php

namespace App\Models;

class MedicalHistory extends _Base
{
    public $timestamps = false;

    public function patient(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
