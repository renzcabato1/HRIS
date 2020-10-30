<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManpowerApprover extends Model
{
    //
    public function user_info()
    {
        return $this->hasOne(User::class,'id','signatories');
    }
    public function manpower_infor()
    {
        return $this->hasOne(Manpower::class,'id','manpower_id');
    }
}
