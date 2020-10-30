<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentEmployee extends Model
{
    //
    protected $connection = 'hr_portal';
    
    protected $table = 'department_employee';

    public function EmployeeView()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}
