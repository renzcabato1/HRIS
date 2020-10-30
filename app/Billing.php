<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    //
    protected $connection = 'announcement_portal';
    public function accountability_info()
    {
        return $this->hasOne(Accountability::class,'account_number','account_id');
    }
    public function billing_info()
    {
        return $this->hasMany(Billing::class,'account_id','account_id');
    }
}
