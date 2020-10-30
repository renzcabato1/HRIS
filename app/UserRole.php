<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    //
    public function role_data()
    {
        return $this->hasOne(Role::class,'id','role_id');
    }
}
