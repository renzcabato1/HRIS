<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplicantHistory extends Model
{
    //

    public function user_info()
    {
        return $this->hasOne(User::class,'id','action_by');
    }
    public function interviewer_info()
    {
        return $this->hasOne(User::class,'id','interviewer');
    }
}
