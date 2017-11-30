<?php

namespace App;

class NotaryOffice extends Model
{
    public function specialties()
    {
        return $this->belongsToMany(Specialty::class);
    }

    public function assignSpecialty($specialty_id)
    {
        return $this->specialties()->save(
            Specialty::where('id', $specialty_id)->firstOrFail()
        );
    }

    public function hasSpecialty($specialty)
    {
        if (is_string($specialty)) {
            return $this->specialties->contains('description', $specialty);
        }

        return !! $specialty->intersect($this->specialties)->count();
    }
}
