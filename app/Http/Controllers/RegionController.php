<?php

namespace App\Http\Controllers;
use App\City;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    //
    public function getCity(Request $request)
    {
        $cities = City::where('region_id',$request->regionId)->orderBy('city_name','asc')->get();
        return $cities;
    }
}
