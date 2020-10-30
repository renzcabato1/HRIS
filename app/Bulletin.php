<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    //
    
    protected $connection = 'announcement_portal';

    public function created_by()
    {
        return $this->hasOne(User::class,'id','add_by');
    }
}
