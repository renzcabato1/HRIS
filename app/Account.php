<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //

    public function user_info()
    {
        return $this->hasOne(Employee::class,'user_id','user_id');
    }
    public function role_info()
    {
        return $this->hasmany(UserRole::class,'user_id','user_id');
    }
}
