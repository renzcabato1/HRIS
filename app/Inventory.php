<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $connection = 'hr_portal';

    public function employee_info()
    {
        return $this->hasOne(Employee::class,'user_id','add_by');
    }
    public function accountabilities()
    {
        return $this->hasMany(EmployeeAccountability::class);
    }
    public function pdf_module()
    {
        // return "";
    
        return BillUpload::where('content','like','%'.$this->service_number.'%')->orWhere('content','like','%'.$this->account_number.'%')->get();
    }

}
