<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManpowerApplicant extends Model
{
    //
    public function manpower_info()
    {
        return $this->hasOne(Manpower::class,'id','manpower_id');
    }
    public function applicant_info()
    {
        return $this->hasOne(Applicant::class,'id','applicant_id');
    }
    public function applicant_history()
    {
        return $this->hasMany(ApplicantHistory::class,'applicant_id','applicant_id')->orderBy('id','desc');
    }
    public function applicant_history_interviewer()
    {
        return $this->hasMany(ApplicantHistory::class,'applicant_id', 'applicant_id')->orderBy('id','desc');
    }
}
