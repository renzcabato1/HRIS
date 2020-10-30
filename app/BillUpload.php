<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillUpload extends Model
{
    //
    
    protected $connection = 'hr_portal';
    public function upload_info()
    {
        return $this->hasOne(User::class,'id','uploaded_by');
    }
}
