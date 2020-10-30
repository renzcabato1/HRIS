<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manpower extends Model
{
    //
    public function request_info()
    {
        return $this->hasOne(User::class,'id','request_by');
    }
    public function company_info()
    {
        return $this->hasOne(Company::class,'id','company_id');
    }
    public function location_info()
    {
        return $this->hasOne(Location::class,'id','location_id');
    }
    public function position_info()
    {
        return $this->hasOne(Job::class,'id','position_title');
    }
    public function department_info()
    {
        return $this->hasOne(Department::class,'id','department_id');
    }
    public function reporting_to_info()
    {
        return $this->hasOne(User::class,'id','reporting_to');
    }
    public function manager_info()
    {
        return $this->hasOne(User::class,'id','immediate_manager');
    }
    public function department_head_info()
    {
        return $this->hasOne(User::class,'id','department_head');
    }
    public function finance_manager_info()
    {
        return $this->hasOne(User::class,'id','finance_manager');
    }
    public function hr_operation_info()
    {
        return $this->hasOne(User::class,'id','hr_operation');
    }
    public function hr_head_info()
    {
        return $this->hasOne(User::class,'id','hr_head');
    }
    public function replacement_info()
    {
        return $this->hasOne(User::class,'id','replacement_id');
    }
    public function manpower_approver()
    {
        return $this->hasMany(ManpowerApprover::class);
    }
    
}
