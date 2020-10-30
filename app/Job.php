<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    public function qualifications()
    {
        return $this->hasMany(JobQualification::class);
    }
}
