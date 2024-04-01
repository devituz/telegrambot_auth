<?php

namespace App\Models;

class Payment extends _Base
{

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function patient(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

}
