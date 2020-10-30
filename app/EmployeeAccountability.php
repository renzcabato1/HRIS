<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeAccountability extends Model
{
    //
    protected $connection = 'hr_portal';

    public function user_info()
    {
        return $this->hasOne(Employee::class,'user_id','user_id');
    }
    public function inventory_info()
    {
        return $this->hasOne(Inventory::class,'id','inventory_id');
    }
}
