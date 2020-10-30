<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    //
    public function work_experience_info()
    {
        return $this->hasMany(WorkExperience::class,'applicant_id','id');
    }
    public function education_info()
    {
        return $this->hasMany(ApplicantEducation::class,'applicant_id','id');
    }
    public function manpower_info()
    {
        return $this->hasMany(ManpowerApplicant::class,'applicant_id','id');
    }
}
