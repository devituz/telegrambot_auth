<?php

namespace App\Models;

class Patient extends _Base
{

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function phones(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Phone::class);
    }

    public function medical_histories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MedicalHistory::class);
    }

    public function payments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Payment::class);
    }




}
