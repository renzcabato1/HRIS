<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
    public function cities()
    {
        return $this->hasMany(City::class,'region_id','id')->orderBy('city_name');
    }
}
