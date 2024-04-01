<?php

namespace App\Models;

class Phone extends _Base
{
    public $timestamps = false;

    protected $guarded = ['id'];

    protected $hidden = [];

    public function patient(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
