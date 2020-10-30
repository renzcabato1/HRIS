<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadBilling extends Model
{
    //
    protected $connection = 'announcement_portal';
    public function upload_info()
    {
        return $this->hasOne(User::class,'id','upload_by');
    }
    public function bill_info()
    {
        return $this->hasOne(Inventory::class,'account_number','account_number');
    }
    
  
}
